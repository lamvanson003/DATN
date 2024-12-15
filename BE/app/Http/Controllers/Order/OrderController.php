<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Enums\Order\OrderStatus;
use Illuminate\Http\Request;

use App\Mail\OrderStatusUpdated;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function index()
    {   
        $status = OrderStatus::asSelectArray();
        $orders = Order::with('order_details')->orderBy('id','desc')->get();
        return view('order.index', compact('orders','status'));
    }

    public function edit($id)
    {
        $order = Order::with('order_details')->findOrfail($id);

        $totalAmount = $order->order_details->sum(function($order_detail) {
            $priceToUse = $order_detail->product_variant->sale ?? $order_detail->product_variant->price;
            return $order_detail->quantity * $priceToUse;
        });

        $status = OrderStatus::asSelectArray();
        $payment_method = OrderStatus::asSelectArray();
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

        Mail::to($order->email)->send(new OrderStatusUpdated($order));

        return redirect()->back()->with('success', 'Đơn hàng đã được cập nhật thành công!');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        switch ($order->status->value) {
            case OrderStatus::Deleted:
                $order->delete();
                break;
            default:
                $order->status = $request->status;
                $order->save();
                break;
        }

        return redirect()->back()->with('success','Thực hiện thành công');
    }

    public function updateIndex(Request $request)
    {
        $ids = $request->input('ids'); 
        $status = $request->input('status');
        if (empty($ids)) {
            return redirect()->back()->with('message', 'Không có đơn hàng nào được chọn');
        }

        foreach ($ids as $id) {
            $order = Order::findOrFail($id);
            $order->update([
                'status' => $status,
            ]);

            Mail::to($order->email)->send(new OrderStatusUpdated($order));
        }    
        return redirect()->back()->with('success','Thực hiện thành công');
    }


    public function getByStatus($status)
    {
        $order = Order::with('user')->where('status',$status)
        ->orderBy('id','desc')
        ->get();
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
        
        Mail::to($order->email)->send(new OrderStatusUpdated($order));

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }

}
