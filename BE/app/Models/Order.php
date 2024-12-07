<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Order\OrderStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $fillable = ['user_id','payment_method_id','discount_id','code','shipping_method','fullname','gender',
                            'email',
                            'phone',
                            'address','note','total_price','status','completed','processed_at'
                        ];


    public function paymentMethod(){
        return $this->belongsTo(Payment_method::class,'payment_method_id');
    }

    public function order_details(){
        return $this->hasMany(OrderDetail::class,'order_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function getOrder(){
        $dateTime = Carbon::now();
        $startTime = $dateTime->copy()->subMinutes(5);
        $endTime = $dateTime->copy()->endOfMinute();    
        return Order::whereBetween('created_at', [$startTime, $endTime])->whereNull('processed_at')->get();
    }
    
    protected $casts = [
        'status' => OrderStatus::class,
    ];
}