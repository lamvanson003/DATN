<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use Exception;

use App\Enums\Category\CategoryStatus;
use App\Enums\Brand\BrandStatus;
use App\Enums\Status;
use App\Enums\Product\ProductStatus;
use App\Http\Resources\Api\Product\ProductResource;
use App\Http\Resources\Api\Product\ProductDetailResource;
use App\Models\Product;
use App\Models\Category;
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

            // Lấy tất cả sản phẩm trong danh mục
            $products = Product::with([
                'category',
                'brand',
                'product_variant.comments'
            ])
                ->where('status', ProductStatus::Active)
                ->where('category_id', $category->id)
                ->when($brandId, function ($query, $brandId) {
                    $query->where('brand_id', $brandId);
                })
                ->get();

            $flattenedVariants = $products->flatMap(function ($product) {
                return $product->product_variant->map(function ($variant) use ($product) {
                    return [
                        'id' => $variant->id,
                        'name' => $product->name, 
                        'slug' => $product->slug,
                        'category' => optional($product->category)->name,
                        'brand' => optional($product->brand)->name,
                        'image' => $variant->images,
                        'storage' => $variant->storage,
                        'price' => $variant->price,
                        'sale' => $variant->sale,
                        'percent' => (!is_null($variant->sale) && $variant->sale < $variant->price && $variant->price > 0)
                            ? round((($variant->price - $variant->sale) / $variant->price) * 100)
                            : null,
                        'instock' => $variant->instock,
                        'sold' => $variant->sold,
                        'is_flash_sale' => $variant->is_flash_sale,
                    ];
                });
            });

            return response()->json([
                'success' => true,
                'data' => $flattenedVariants
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
                        $query->where('status', Status::Active);
                    },
                    'product_variant.comments' => function ($query) {
                        $query->selectRaw('AVG(rating) as average_rating, COUNT(*) as total_comments');
                    },
                ]
            )->where('status', ProductStatus::Active)->get();

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

    public function detail($slug)
    {
        try {

            $product = Product::with(
                [
                    'category' => function ($query) {
                        $query->where('status', CategoryStatus::Active);
                    },
                    'brand' => function ($query) {
                        $query->where('status', BrandStatus::Active);
                    },
                    'product_image_items' => function ($query) {
                        $query->where('status', Status::Active);
                    },
                    'product_variant.comments' => function ($query) {
                        $query->selectRaw('AVG(rating) as average_rating');
                    },

                ]
            )
                ->where('slug', $slug)
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
