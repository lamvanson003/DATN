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
        $order = Order::with('user')->where('status',$status)->get();  
        $title = OrderStatus::getDescription($status);
        return view('order.status', compact('order','title'));
    }
    
    public function delete($id)
    {
        $order = Order::findOrfail($order_id);
        $order->status = OrderStatus::Deleted;
        $order->save();

        return redirect()->back()->with('success', 'Thực hiện thành công.');
    }

    public function changeStatus($order_id)
    {
        $order = Order::findOrfail($order_id);
        switch ($order->status) {
            case OrderStatus::Pending:
                $order->status = OrderStatus::Confirm;
                break;
            case OrderStatus::Confirm:
                $order->status = OrderStatus::Awaiting; 
                break;
            case OrderStatus::Awaiting:
                $order->status = OrderStatus::InTransit; 
                break;
            case OrderStatus::InTransit:
                $order->status = OrderStatus::Delivered; 
                break;
            default:
                return redirect()->back()->with('error', 'Trạng thái không thể cập nhật.');
        }

        $order->save();

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }

}
