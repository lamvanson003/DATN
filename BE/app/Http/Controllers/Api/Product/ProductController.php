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

use Illuminate\Support\Facades\Log;

class ProductController extends controller{

    public function index() {
        try {
            $products = Product::with(
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
                'message' => 'Failed to fetch data',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function detail($id) {
        try {

            $product_variant = Product::with(
                ['product' => function ($query) {
                    $query->where('status', ProductStatus::Active);
                },
                'product.category' => function ($query) {
                    $query->where('status', CategoryStatus::Active);
                }, 
                'product.brand'=> function ($query){
                    $query->where('status', BrandStatus::Active);
                }, 
                'product.product_image_items' => function ($query){
                    $query->where('status', Status::Active);
                }, 
                'product.variantColor.color' => function ($query){
                    $query->where('status', Status::Active);
                },
                ])
                ->findOrFail($id);
                Log::info('mess',['mess'=> $product_variant]);
            return response()->json([
                'success' => true,
                'data' => new ProductDetailResource($product_variant)
            ], 200);
        } catch (\Throwable $e) {
            Log::info('mess',['mess'=> $e]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch product details',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    
}