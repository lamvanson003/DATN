<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use Exception;

use App\Enums\Category\CategoryStatus;
use App\Enums\Brand\BrandStatus;
use App\Enums\Status;
use App\Enums\Product\ProductStatus;
use App\Http\Resources\Api\Product\ProductResource;
use App\Http\Resources\Api\Product\ProductVariantResource;
use App\Http\Resources\Api\Product\ProductDetailResource;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends controller
{

    public function productByCate(Request $request, $slug)
    {
        try {
            $category = Category::where('slug', $slug)
                ->where('status', CategoryStatus::Active)
                ->first();

            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found'
                ], 404);
            }

            $brandId = $request->get('brand_id');

            $products = Product::with([
                'category',
                'brand',
                'product_variant.comments',
                'product_image_items' => function ($query){
                    $query->orderBy('posittion', 'asc');
                }
            ])
                ->where('status', ProductStatus::Active)
                ->where('category_id', $category->id)
                ->when($brandId, function ($query, $brandId) {
                    $query->where('brand_id', $brandId);
                })
                ->whereHas('product_variant', function ($query) {
                    $query->where('is_flash_sale', false);
                })
                ->orderBy('id','desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => ProductResource::collection($products)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch data',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        try {
                $products = Product::with(
                    [
                        'category' => function ($query) {
                            $query->where('status', CategoryStatus::Active);
                        },
                        'brand' => function ($query) {
                            $query->where('status', BrandStatus::Active);
                        },
                        'product_variant',
                        'product_image_items' => function ($query) {
                            $query->where('status', Status::Active)
                            ->orderBy('posittion', 'asc');
                        },
                        'product_variant.comments' => function ($query) {
                            $query->selectRaw('AVG(rating) as average_rating, COUNT(*) as total_comments');
                        },
                    ]
                )->where('status', ProductStatus::Active)
                ->orderBy('id','desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => ProductResource::collection($products)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch data',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function hotdeal(Request $request)
{
    try {
        $categoryFilter = $request->query('category');

        if (!$categoryFilter) {
            return response()->json([
                'success' => false,
                'message' => 'Category filter is required.'
            ], 400);
        }

        $category = Category::where('status', CategoryStatus::Active)
            ->where('slug', $categoryFilter)
            ->first();

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.'
            ], 404);
        }

        $productVariants = ProductVariant::with([
                'product' => function ($query) use ($category) {
                    $query->where('status', ProductStatus::Active)
                        ->where('category_id', $category->id);
                },
                'product.brand' => function ($query) {
                    $query->where('status', BrandStatus::Active);
                },
                'comments' => function ($query) {
                    $query->selectRaw('AVG(rating) as average_rating, COUNT(*) as total_comments');
                },
                'product.product_image_items' => function ($query) {
                    $query->where('status', Status::Active);
                },
            ])
            ->whereHas('product', function ($query) use ($category) {
                $query->where('status', ProductStatus::Active)
                    ->where('category_id', $category->id);
            })
            ->orderBy('sold', 'desc') 
            ->limit(10)
            ->get();

        if ($productVariants->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No hot deal product variants found for the selected category.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => ProductVariantResource::collection($productVariants),
        ], 200);
    } catch (\Throwable $th) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch data',
            'error' => $th->getMessage()
        ], 500);
    }
}


    public function detail($slug)
    {
        try {

            $product = Product::
                where('slug', $slug)
                ->where('status', ProductStatus::Active)
                ->firstOrFail();
            return response()->json([
                'success' => true,
                'data' => new ProductDetailResource($product)
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch product details',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
