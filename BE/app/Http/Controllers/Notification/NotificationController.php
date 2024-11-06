<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification;




class NotificationController extends Controller
{
  
    public function index()
    {
        $notification = Notification::all();
        return view('notification.index', compact('notification'));
    }

   
}
