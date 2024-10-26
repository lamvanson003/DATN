<?php

namespace App\Http\Controllers\Api\Payment;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VnpayService;

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
            'products.*.quantity' => 'required|integer',
            'products.*.price' => 'required|numeric',
            'products.*.sale' => 'nullable|numeric',
        ]);

        $paymentUrl = $this->vnpayService->createPaymentUrl([
            'transaction_id' => uniqid(),
            'order_description' => "Thanh toán cho đơn hàng",
            'amount' => $validatedData['total_price'],
        ]);

        session()->put('order_data', $validatedData);

        return response()->json(['payment_url' => $paymentUrl]);
    }

    public function callback(Request $request)
    {
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');

        // Chỉ xử lý khi thanh toán thành công
        if ($vnp_ResponseCode == "00") {
            $validatedData = session()->get('order_data');

            if (!$validatedData) {
                return redirect()->route('user.orders')->with('error', 'Không tìm thấy dữ liệu đơn hàng');
            }

            DB::beginTransaction();
            try {
                $code = random_int(1000, 9999);

                $order = Order::create([
                    'code' => $code,
                    'user_id' => $validatedData['user_id'] ?? null,
                    'payment_method_id' => $validatedData['payment_method_id'],
                    'discount_id' => $validatedData['discount_id'] ?? null,
                    'fullname' => $validatedData['fullname'],
                    'phone' => $validatedData['phone'],
                    'address' => $validatedData['address'],
                    'email' => $validatedData['email'],
                    'note' => $validatedData['note'],
                    'total_price' => $validatedData['total_price'],
                    'status' => 'completed',
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
                        $productVariant->sold += $productData['quantity'];
                        $productVariant->save();
                    }
                }

                DB::commit();
                session()->forget('order_data');
                
                return 'Thanh toán thành công';

            } catch (\Exception $e) {
                DB::rollBack();
                return 'Có lỗi xảy ra trong quá trình xử lý đơn hàng';
            }
        } else {
            return 'Thanh toán thất bại';
        }
    }
}