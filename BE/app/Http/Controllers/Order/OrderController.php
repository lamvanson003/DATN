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
        $orders = Order::with('order_details')->orderBy('id','desc')->get();
        return view('order.index', compact('orders'));
    }

    public function edit($id)
    {
        $order = Order::with('order_details')->findOrfail($id);

        $totalAmount = $order->order_details->sum(function($order_detail) {
            $priceToUse = $order_detail->product_variant->sale ?? $order_detail->product_variant->price;
            return $order_detail->quantity * $priceToUse;
        });

        $status = OrderStatus::asSelectArray();
        return view('order.edit', compact('order','status','totalAmount'));
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $order = Order::findOrfail($data['id']);
        $order->update([
            'fullname' => $data['fullname'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'note' => $data['note'],
            'status' => $data['status'],
        ]);
        return redirect()->route('admin.order.edit', $order->id)->with('success', 'Đơn hàng đã được cập nhật thành công!');
    }

    public function getByStatus($status)
    {
        $order = Order::with('user')->where('status',$status)->get();
        $title = OrderStatus::getDescription($status);
        return view('order.status', compact('order','title'));
    }

    public function delete($id)
    {
        $order = Order::findOrfail($id);
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
