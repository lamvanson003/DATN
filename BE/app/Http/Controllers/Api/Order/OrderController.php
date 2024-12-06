<?php
namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\Resources\Api\Order\OrderResource;
use Illuminate\Http\JsonResponse;
use App\Enums\User\UserRole;
use App\Models\FlashSale;
use App\Models\ProductVariant;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller {
    public function detailByPhone(Request $request) {
        $validatedData = $request->validate([
            'phone' => 'required|string',
        ]);

        $orders = Order::with('order_details.product_variant.product')
                        ->where('phone', $validatedData['phone'])
                        ->orderBy('id','desc')
                        ->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No orders found for this phone number.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => OrderResource::collection($orders)
        ], 200);
    }

    public function detail($id){
        $order = Order::with('order_details.product_variant.product')->findOrfail($id);
        return response()->json([
            'success' => true,
            'data' => new OrderResource($order)
        ], 200);
    }
    public function create(Request $request){
        $validatedData = $request->validate([
            'user_id' => 'nullable|integer',
            'payment_method_id' => 'required|integer',
            'discount_id' => 'nullable|integer',
            'fullname' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'note' => 'nullable|string',
            'total_price' => 'required|numeric',
            'products' => 'required|array',
            'products.*.product_variant_id' => 'required|integer',
            'products.*.quantity' => 'required|integer',
            'products.*.price' => 'required|numeric',
            'products.*.sale' => 'nullable|numeric',
        ]);
        try {
            DB::beginTransaction();
            if ($validatedData['discount_id']) {
                $existingOrder = Order::where('phone', $validatedData['phone'])
                    ->where('discount_id', $validatedData['discount_id'])
                    ->first();
                
                if ($existingOrder) {
                    return response()->json([
                        'success' => false,
                        'message' => 'số điện thoại này đã sử dụng mã rồi.',
                    ], 400);
                }
            }
            $code = '#'.random_int(1,9999);
            $order = Order::create([
                'code' => $code,'user_id' => $validatedData['user_id'] ?? null,
                'payment_method_id' => $validatedData['payment_method_id'],
                'discount_id' => $validatedData['discount_id'] ?? null,
                'fullname' => $validatedData['fullname'],
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
                'email' => $validatedData['email'],
                'note' => $validatedData['note'],
                'total_price' => $validatedData['total_price'],
                'status' => 'pending',
            ]); 
            if ($validatedData['discount_id']) {
                $discount = \App\Models\Discount::find($validatedData['discount_id']);
                if ($discount && $discount->amount > 0) {
                    $discount->amount -= 1;
                    $discount->save();
                }
            }
            foreach ($validatedData['products'] as $productData) {
                $orderDetail =OrderDetail::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $productData['product_variant_id'],
                    'quantity' => $productData['quantity'],
                    'price' => $productData['price'],
                    'sale' => $productData['sale'] ?? 0,
                ]);

                $productVariant = ProductVariant::find($productData['product_variant_id']);

                if ($productVariant) {
                    $productVariant->instock -= $productData['quantity'];
                    $productVariant->sold += $productData['quantity'];
                    $productVariant->save();
                }

                
            }
            DB::commit();

            return response()->json([
                'message' => 'Order processed successfully',
                'order_id' => $order->id,
                'product_variant_id' => $orderDetail -> product_variant_id,
                'order_code' => $order->code,
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create order', 'details' => $e->getMessage()], 500);
        }
    }

}