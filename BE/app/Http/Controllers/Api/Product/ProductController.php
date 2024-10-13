<?php 
namespace App\Http\Controllers\Api\Product;
use App\Http\Controllers\Controller;
use Exception;
use App\Models\Product;
use App\Enums\Category\CategoryStatus;
use App\Enums\Brand\BrandStatus;
use App\Enums\Status;
use App\Enums\Product\ProductStatus;
use App\Http\Controllers\Api\Resources\Product\ProductResource;
use App\Models\ProductVariant;

class ProductController extends controller{

    public function index() {
        try {
            $products = ProductVariant::with(
                [
                    'product' => function ($query) {
                        $query->where('status', ProductStatus::Active);
                    }
                ],
                ['product.category' => function ($query) {
                $query->where('status', CategoryStatus::Active);
                }, 
                'prodyct.brand'=> function ($query){
                    $query->where('status', BrandStatus::Active);
                }, 
                'product.product_variant', 
                'product.product_image_items' => function ($query){
                    $query->where('status', Status::Active);
                }, 
                'product.variantColor.color' => function ($query){
                    $query->where('status', Status::Active);
                },
                ])
                ->get();

            return response()->json([
                'success' => true,
                'data' => ProductResource::collection($products)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch categories',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function detail($id) {
        try {
            $products = Product::with(
                ['category' => function ($query) {
                $query->where('status', CategoryStatus::Active);
                }, 
                'brand'=> function ($query){
                    $query->where('status', BrandStatus::Active);
                }, 
                'product_variant', 
                'product_image_items' => function ($query){
                    $query->where('status', Status::Active);
                }, 
                'variantColor.color' => function ($query){
                    $query->where('status', Status::Active);
                },
                ])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $products
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch categories',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    
}