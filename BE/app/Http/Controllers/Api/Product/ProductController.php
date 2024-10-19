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

    // LẤY IPHONE
    public function productByIphone() {
        try {
            $products = Product::with(
                [
                    'category' => function ($query) {
                    $query->where('status', CategoryStatus::Active)
                        ->where('id',2);
                    }, 
                    'brand'=> function ($query){
                        $query->where('status', BrandStatus::Active);
                    }, 
                    'product_variant', 
                    'product_image_items' => function ($query){
                        $query->where('status', Status::Active);
                    }, 
                    'product_variant.comments' => function($query){
                        $query->selectRaw('AVG(rating) as average_rating, COUNT(*) as total_comments');
                    },
                ])
                ->where('status', ProductStatus::Active)
                ->where('')
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
    public function index() {
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
                'product_variant.comments' => function($query){
                    $query->selectRaw('AVG(rating) as average_rating, COUNT(*) as total_comments');
                },
                ])->where('status', ProductStatus::Active)->get();

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

    public function detail($slug) {
        try {

            $product = Product::with(
                [
                'category' => function ($query) {
                    $query->where('status', CategoryStatus::Active);
                }, 
                'brand'=> function ($query){
                    $query->where('status', BrandStatus::Active);
                }, 
                'product_image_items' => function ($query){
                    $query->where('status', Status::Active);
                },              
                'product_variant.comments' => function($query){
                    $query->selectRaw('AVG(rating) as average_rating');
                },

                ])
                ->where('slug',$slug)
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