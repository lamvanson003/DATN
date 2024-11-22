<?php
namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    
    public function build()
    {
        return $this->subject('Cập nhật trạng thái đơn hàng')
                    ->view('sentmail.order.order_status_updated')
                    ->with([
                        'order' => $this->order,
                    ]);
    }
}
