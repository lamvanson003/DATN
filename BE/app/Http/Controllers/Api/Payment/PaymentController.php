<?php

namespace App\Http\Controllers\Api\Payment;

use Illuminate\Http\Request;
use App\Services\VnpayService;

class PaymentController extends Controller
{
    protected $vnpayService;

    public function __construct(VnpayService $vnpayService)
    {
        $this->vnpayService = $vnpayService;
    }

    // Phương thức tạo URL thanh toán
    public function createPayment(Request $request)
    {
        $orderData = [
            'transaction_id' => uniqid(),
            'order_description' => 'Thanh toán đơn hàng từ cửa hàng ABC',
            'amount' => $request->amount,
        ];

        // Tạo URL thanh toán qua VNPAY
        $paymentUrl = $this->vnpayService->createPaymentUrl($orderData);
        return redirect($paymentUrl);
    }

    // Phương thức xử lý callback từ VNPAY
    public function callback(Request $request)
    {
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        if ($vnp_ResponseCode == "00") {
            return response()->json(['status' => 'success', 'message' => 'Thanh toán thành công']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Thanh toán thất bại']);
        }
    }
}
