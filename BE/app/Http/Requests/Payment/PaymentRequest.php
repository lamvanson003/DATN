<?php

namespace App\Http\Requests\Payment;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class PaymentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the POST request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
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
        ];
    }
}
