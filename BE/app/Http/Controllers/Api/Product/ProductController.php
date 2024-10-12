<?php 
namespace App\Http\Controllers\Api\Product;
use App\Http\Controllers\Controller;
use Exception;
use App\Models\Product;
use App\Enums\Product\ProductStatus;

class ProductController extends controller{

    public function index() {
        try {
            $products = Product::all()->where('status',ProductStatus::Active);

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

    public function detail($id) {
        try {
            $products = Product::findOrFail($id);

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