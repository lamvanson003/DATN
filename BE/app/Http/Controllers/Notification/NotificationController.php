<?php

namespace App\Http\Controllers\Notification;

use App\Enums\Notification\{NotificationReadAt
    ,NotificationStatus,
    NotificationType,
    NotificationTypes,
    NotificationOption,
};
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Notification\NotificationRequest;

use App\Mail\OrderStatusUpdated;
use App\Mail\NotificationVoucher;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Event\Test\NoticeTriggered;

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
        $notifiType = Notification::where('type',$type)->get();
        $title = NotificationType::getDescription($type);
        return view('notification.type', compact('notifiType','title'));
    }

    public function edit($id)
    {
        $notification = Notification::findOrFail($id);
        return view('notification.edit', [
            'notification' => $notification,
            'read_at' => NotificationReadAt::asSelectArray(),
            'type' => NotificationType::asSelectArray(),
        ]);
    }

    public function update(Request $request)
    {   
        $data = $request->all();
        $notification = Notification::findOrFail($data['id']);
        
        $notification->title = $data['title'];
        $notification->message = $data['message'];
        $notification->type = $data['type'];

        $notification->save();

        return redirect()->back()->with('success', 'Thực hiện thành công.');
    }

    public function delete($id)
    {   
        $notification = Notification::findOrfail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Thực hiện thành công.');
    }

    public function store(NotificationRequest $request){

        
        $data = $request->validated();
        $users = User::active()->get();
        $types = $data['types'];
        $url = $data['url'] ?? null;
        switch ($types) {
            case NotificationTypes::All:
                $users = User::active()->get();
                
                foreach ($users as $user) {
                    $email = $user->email;
                    $dataNoti = [
                        'title' => $data['title'],
                        'message' => $data['message'],
                        'user_id' => $user->id,
                        'type' => $data['type'],
                    ];

                    $notification = Notification::create($dataNoti);
                    Mail::to($email)->send(new NotificationVoucher($notification,$url));
                }
                break;
            case NotificationTypes::Customer:
                $users = User::GetUserActive();
                $option = $data['option'];
                if ($option == NotificationOption::All) {
                    foreach ($users as $user) {
                        $dataNoti = [
                            'title' => $data['title'],
                            'message' => $data['message'],
                            'user_id' => $user->id,
                            'type' => $data['type'],
                        ];
                        $notification = Notification::create($dataNoti);
                        Mail::to($user->email)->send(new NotificationVoucher($notification,$url));
                    }
                } 
                if($option == NotificationOption::One){
                    foreach ($data['user_id'] as $userId) {
                        $user = User::findOrfail($userId);
                        $dataNoti = [
                            'title' => $data['title'],
                            'message' => $data['message'],
                            'user_id' => $user->id,
                            'type' => $data['type'],
                        ];
                        $notification = Notification::create($dataNoti);
                        Mail::to($user->email)->send(new NotificationVoucher($notification,$url));
                    }

                }
                

                break;
            default:
                # code...
                break;
        }
        return redirect()->route('admin.notification.index')->with('success','Thực hiện thành công');
    }

    public function create(){
        $type = NotificationType::asSelectArray();
        $types = NotificationTypes::asSelectArray();
        $status = NotificationStatus::asSelectArray();
        $options = NotificationOption::asSelectArray();
        return view('notification.create',compact(
            'options',
            'types',
            'type',
            'status'));
    }
}
