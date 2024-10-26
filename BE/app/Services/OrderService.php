<?php
namespace App\Services;

use App\Models\Order;
use App\Enums\Order\OrderStatus;

class OrderService
{   
    public function countAll(){
        $q = Order::count();
        return $q;
    }
    public function countPending(){
        $q = Order::where('status',OrderStatus::Pending)->count();
        return $q;
    }
    public function countConfirm(){
        $q = Order::where('status',OrderStatus::Confirm)->count();
        return $q;
    }
    public function countAwaiting(){
        $q = Order::where('status',OrderStatus::Awaiting)->count();
        return $q;
    }
    public function countInTransit(){
        $q = Order::where('status',OrderStatus::InTransit)->count();
        return $q;
    }
    public function countDelivered(){
        $q = Order::where('status',OrderStatus::Delivered)->count();
        return $q;
    }
    public function countCanceled(){
        $q =  Order::where('status',OrderStatus::Canceled)->count();
        return $q;
    }
    public function countReturned(){
        $q = Order::where('status',OrderStatus::Returned)->count();
        return $q;
    }
}
