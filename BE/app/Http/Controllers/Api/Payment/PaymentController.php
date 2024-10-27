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

        $temporaryOrder = TemporaryOrder::create([
            'order_data' => json_encode($validatedData), 
        ]);

        Log::info('mess',['es0'=> $temporaryOrder->id]);
        $paymentUrl = $this->vnpayService->createPaymentUrl([
            'transaction_id' => $temporaryOrder->id, 
            'order_description' => "Thanh toán cho đơn hàng".$temporaryOrder->id,
            'amount' => $validatedData['total_price'],
        ]);

        return response()->json(['payment_url' => $paymentUrl]);
    }

    public function callback(Request $request)
    {       
        
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $transactionId = $request->get('vnp_TxnRef');

        if ($vnp_ResponseCode == '00' && $transactionId) 
        {
            $tempOrder = TemporaryOrder::find($transactionId);
            $orderData = json_decode($tempOrder->order_data, true);

            DB::beginTransaction();
            try {

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
                    'status' => 'pending',
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

                DB::commit();

                return response()->json([
                    'message' => 'Order processed successfully',
                    'order_url' => route('order.detail', ['id' => $order->id]),
                    'order_id' => $order->id,
                    'order_code' => $order->code,
                ], 200);

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
