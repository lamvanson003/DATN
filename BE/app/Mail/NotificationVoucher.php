<?php
namespace App\Mail;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationVoucher extends Mailable
{
    use Queueable, SerializesModels;

    public $notification;
    public $url;

    
    public   function __construct(
        Notification $notification,
        string $url = null,
        )
    {
        $this->notification = $notification;
        $this->url = $url;
    }

    
    public function build()
    {
        return $this->subject($this->notification->title)
                    ->view('sentmail.notification.voucher')
                    ->with([
                        'notification' => $this->notification,
                        'url' => $this->url,
                    ]);
    }
}
