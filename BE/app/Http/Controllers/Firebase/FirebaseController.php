<?php
namespace App\Http\Controllers\Firebase;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    protected $messaging;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(storage_path('app/firebase_credentials.json'));
        $this->messaging = $factory->createMessaging();
    }

    public function sendNotification(Request $request)
    {
        $message = CloudMessage::withTarget('token', $request->input('token'))
            ->withNotification(['title' => 'Test Notification', 'body' => 'This is a test notification!']);

        try {
            $this->messaging->send($message);
            return response()->json(['success' => 'Notification sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
