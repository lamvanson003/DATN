<?php

namespace App\Http\Requests\Discount;

use App\Enums\Discount\DiscountStatus;
use App\Enums\Discount\DiscountType;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class DiscountRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the POST request.
     *
     * @return array
     */
   

     protected function prepareForValidation()
     {
         $this->merge([
             'type' => (int) $this->type,    
             'status' => (int) $this->status 
         ]);
     }
     
     protected function methodPost()
     {
         return [
             'code' => 'required|string|min:6|max:255',
             'discount_value' => 'required|numeric',
             'desc' => 'nullable|string',
             'date_start' => 'required|date|after_or_equal:today',
             'amount' => 'required|integer|min:0',
             'date_end' => 'required|date|after_or_equal:date_start',
             'type' => 'required|in:' . implode(',', array_keys(\App\Enums\Discount\DiscountType::asSelectArray())),
             'status' => 'required|in:' . implode(',', array_keys(\App\Enums\Discount\DiscountStatus::asSelectArray())),
         ];
     }
     
     protected function methodPut()
     {
         return [
             'id' => ['required', 'exists:discounts,id'],
             'code' => 'required|string|max:255',
             'discount_value' => 'required|numeric',
             'desc' => 'nullable|string',
             'amount' => 'required|integer|min:0',
             'date_start' => 'required|date|after_or_equal:date_start',
             'date_end' => 'required|date|after_or_equal:date_start',
             'type' => ['required', 'integer', new Enum(DiscountType::class)],
             'status' => ['required', 'integer', new Enum(DiscountStatus::class)],
         ];
     }
     
    }