<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;

class VnpayService
{
    protected $vnp_TmnCode;
    protected $vnp_HashSecret;
    protected $vnp_Url;
    protected $vnp_ReturnUrl;
    protected $vnp_Version;

    public function __construct()
    {
        $this->vnp_TmnCode = config('services.vnpay.tmn_code');
        $this->vnp_HashSecret = config('services.vnpay.hash_secret');
        $this->vnp_Url = config('services.vnpay.url');
        $this->vnp_ReturnUrl = config('services.vnpay.return_url');
        $this->vnp_Version = config('services.vnpay.version');
    }

    public function createPaymentUrl($orderData)
    {
        $vnp_TxnRef = $orderData['transaction_id'];
        $vnp_OrderInfo = $orderData['order_description'];
        $vnp_Amount = $orderData['amount'] * 100;
        $vnp_IpAddr = request()->ip();

        $inputData = [
            "vnp_Version" => $this->vnp_Version,
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $this->vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        ksort($inputData);
        $query = "";
        foreach ($inputData as $key => $value) {
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_SecureHash = hash_hmac('sha512', $query, $this->vnp_HashSecret);
        return $this->vnp_Url . "?" . $query . "vnp_SecureHash=" . $vnp_SecureHash;
    }
}
