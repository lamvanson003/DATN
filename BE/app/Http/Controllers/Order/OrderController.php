<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Enums\Order\OrderStatus;
use Illuminate\Http\Request;



class OrderController extends Controller
{
  
    public function index()
    {
        $order = Order::with('order_details')->get();  
        return view('order.index', compact('order'));
    }

    public function getByStatus($status)
    {
        $order = Order::where('status',$status)->get();  
        $title = OrderStatus::getDescription($status);
        return view('order.index', compact('order','title'));
    }
}
