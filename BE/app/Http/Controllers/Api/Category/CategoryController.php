<?php 
namespace App\Http\Controllers\Api\Category;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class CategoryController extends controller{

    public function index() {
        try {
            $categories = Category::all();

            return response()->json([
                'success' => true,
                'data' => $categories
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