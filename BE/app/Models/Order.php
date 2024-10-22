<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enum\Order\OrderStatus;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $filable = ['user_id','payment_method_id','discount_id','code','shipping_method','fullname','gender',
                            'email',
                            'phone',
                            'address','note','total_price','status'
                        ];






    public function order_details(){
        return $this->hasMany(OrderDetail::class,'order_id');
    }

    protected $cast = [
        'status' => OrderStatus::class,
    ]
}