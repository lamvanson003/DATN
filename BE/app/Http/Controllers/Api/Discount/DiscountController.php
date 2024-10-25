<?php

namespace App\Http\Controllers\Api\Discount;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Resources\Api\Discount\DiscountResource;
use Illuminate\Support\Facades\Log;

class DiscountController extends Controller
{
 
    public function index() {
        try {
            $discounts = Discount::where('status', 1)->get();
            return response()->json([
                'success' => true,
                'data' => DiscountResource::collection($discounts)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch discounts',
                'error' => $th->getMessage()
            ], 500);
        }
    }

  
    public function show($id) {
        try {
            $discount = Discount::where('id', $id)
                ->where('status', 1)
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => new DiscountResource($discount)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch discount details',
                'error' => $th->getMessage()
            ], 500);
        }
    }

  
    public function store(Request $request) {
        try {
            $validated = $request->validate([
                'code' => 'required|unique:discounts',
                'discount_value' => 'required|numeric',
                'discount_type' => 'required|in:percent,fixed',  
                'date_start' => 'required|date',
                'date_end' => 'required|date|after_or_equal:date_start',
                'status' => 'required|in:0,1'
            ]);
    
            if ($validated['discount_type'] == 'percent') {
                $validated['discount_value'] = round($validated['discount_value'], 2);
                if ($validated['discount_value'] > 99) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Discount value cannot exceed 99% for percentage discounts'
                    ], 400);
                }
            }
    
            $discount = Discount::create($validated);
    
            return response()->json([
                'success' => true,
                'data' => new DiscountResource($discount)
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create discount',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    


    public function update(Request $request, $id) {
        try {
            $discount = Discount::findOrFail($id);
            
            $validated = $request->validate([
                'code' => 'required|unique:discounts,code,' . $id,
                'discount_value' => 'required|numeric',
                'discount_type' => 'required|in:percent,fixed', 
                'date_start' => 'required|date',
                'date_end' => 'required|date|after_or_equal:date_start',
                'status' => 'required|in:0,1'
            ]);
    
            if ($validated['discount_type'] == 'percent') {
                $validated['discount_value'] = round($validated['discount_value'], 2);
               
                if ($validated['discount_value'] > 99) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Discount value cannot exceed 99% for percentage discounts'
                    ], 400);
                }
            }
    
            $discount->update($validated);
    
            return response()->json([
                'success' => true,
                'data' => new DiscountResource($discount)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update discount',
                'error' => $th->getMessage()
            ], 500);
        }
    }


    public function destroy($id) {
        try {
            $discount = Discount::findOrFail($id);
            $discount->delete();

            return response()->json([
                'success' => true,
                'message' => 'Discount deleted successfully'
            ], 204);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete discount',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
