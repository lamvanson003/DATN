<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentRequest;
use Illuminate\Http\Request;
use App\Services\VnpayService;
use App\Models\Order;
use App\Models\TemporaryOrder;
use App\Models\OrderDetail; 
use App\Models\ProductVariant; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $vnpayService;

    public function __construct(VnpayService $vnpayService)
    {
        $this->vnpayService = $vnpayService;
    }

    public function createPayment(Request $request)
    {   
        Log::info('Payment Request Data:', ['request' => $request->all()]); 
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
            'products.*.quantity' => 'required|integer|min:1', 
            'products.*.price' => 'required|numeric',
            'products.*.sale' => 'nullable|numeric',
        ]);

        $tempOrder = TemporaryOrder::create([
            'order_data' => json_encode($validatedData),
        ]);

        $paymentUrl = $this->vnpayService->createPaymentUrl([
            'transaction_id' => uniqid(),
            'order_description' => "Thanh toán cho đơn hàng",
            'amount' => $validatedData['total_price'],
            'temp_order_id' => $tempOrder->id, 
        ]);

        return response()->json(['payment_url' => $paymentUrl]);
    }

    public function callback(Request $request, $temp_order_id)
    {       
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');

        dd($temp_order_id);

        if ($vnp_ResponseCode == '00') {
            DB::beginTransaction();
            try {
                $temp_order_id = $request->get('temp_order_id'); 

                $tempOrder = TemporaryOrder::find($temp_order_id);

                if (!$tempOrder) {
                    return response()->json(['message' => 'No order data found'], 400);
                }

                $orderData = json_decode($tempOrder->order_data, true);

                $code = '#'.random_int(1000, 9999);

                $order = Order::create([
                    'code' => $code,
                    'user_id' => $orderData['user_id'] ?? null,
                    'payment_method_id' => $orderData['payment_method_id'],
                    'discount_id' => $orderData['discount_id'] ?? null,
                    'fullname' => $orderData['fullname'],
                    'phone' => $orderData['phone'],
                    'address' => $orderData['address'],
                    'email' => $orderData['email'],
                    'note' => $orderData['note'],
                    'total_price' => $orderData['total_price'],
                    'status' => 'completed',
                ]);

                foreach ($orderData['products'] as $productData) {
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
                        $productVariant->sold += $productData['quantity'];
                        $productVariant->save();
                    }
                }

                $tempOrder->delete();

                DB::commit();

                return response()->json(['message' => 'Order processed successfully'], 200);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Payment Processing Error:', ['error' => $e->getMessage()]);
                return response()->json(['message' => 'Order processing failed'], 500);
            }
        } else {
            return response()->json(['message' => 'Payment failed'], 400);
        }
    }
}
