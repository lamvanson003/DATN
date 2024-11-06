<?php

namespace App\Http\Controllers\Api\Search;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\Api\Product\ProductResource;

class SearchController extends controller
{

    public function searchByProductOrVariant(Request $request)
    {
        try {
            $data = $request->all();

            if (empty($data['name'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Search keyword is required'
                ], 400);
            }

            $query = Product::where('name', 'like', '%' . $data['name'] . '%')
                ->orWhereHas('productVariants', function ($query) use ($data) {
                    $query->where('storage', 'like', '%' . $data['name'] . '%');
                });

            $products = $query->get();

            return response()->json([
                'success' => true,
                'data' => ProductResource::collection($products)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to Find product',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
