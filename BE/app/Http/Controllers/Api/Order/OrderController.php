<?php 
namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\JsonResponse;
use App\Enums\User\UserRole;
use App\Models\ProductVariant;

use Illuminate\Support\Facades\DB;

class OrderController extends Controller {


    public function create(Request $request){
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'payment_method_id' => 'required|integer',
            'discount_id' => 'nullable|integer',
            'fullname' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|email',
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
    
            $order = Order::create([
                'user_id' => $validatedData['user_id'],
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
    
            foreach ($validatedData['products'] as $productData) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $productData['product_variant_id'],
                    'quantity' => $productData['quantity'],
                    'price' => $productData['price'],
                    'sale' => $productData['sale'] ?? 0,
                ]);
    
                $productVariant = ProductVariant::find($productData['product_variant_id']);
                if ($productVariant) {
                    $productVariant->instock -= $productData['quantity']; 
                    $productVariant->save();
                }
            }
    
            DB::commit();
            return response()->json(['message' => 'Order created successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create order', 'details' => $e->getMessage()], 500);
        }
    }
}
