<?php 
namespace App\Http\Controllers\Api\Brand;
use App\Http\Controllers\Controller;
use Exception;
use App\Models\Brand;

class BrandController extends controller{

    public function index() {
        try {
            $brands = Brand::all();

            return response()->json([
                'success' => true,
                'data' => $brands
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