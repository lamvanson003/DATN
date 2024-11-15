<?php

namespace App\Http\Controllers\Notification;

use App\Enums\Notification\{NotificationReadAt,NotificationStatus,NotificationType};
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;


class NotificationController extends Controller
{
  
    public function index()
    {
        $notification = Notification::orderBy('id', 'desc')->get();
        $readAT = NotificationReadAt::asSelectArray();
        $status = NotificationStatus::asSelectArray();
        return view('notification.index', compact('notification','readAT','status'));
    }
    public function type($type)
    {  
        $notifiType = Notification::where('type',$type);
        dd($notifiType);
        return view('notification.type', compact('notifiType'));
    }

    public function delete($id)
    {
        $notification = Notification::findOrfail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Thực hiện thành công.');
    }
}
