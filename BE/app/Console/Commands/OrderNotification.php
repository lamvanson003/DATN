<?php 
namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\Traits\NotifiesViaFirebase;
use App\Enums\Notification\{NotificationReadAt,NotificationStatus,NotificationType};
use App\Models\User;
use App\Models\Order;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class OrderNotification extends Command{

    use NotifiesViaFirebase;

    protected User $userModel;
    protected Order $orderModel;
    protected Notification $notificationModel;

    public function __construct(
            User $userModel,
            Notification $notificationModel,
            Order $orderModel
        ) 
    {   
        parent::__construct(); 
        $this->orderModel = $orderModel;
        $this->userModel = $userModel;
        $this->notificationModel = $notificationModel;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:notification';

     /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if user have  join order on time and notifies them if not.';


    /**
     * Execute the console command.
     *
     * @return int
     * @throws Exception
     */
    public function handle(): int
    {    
        Log::info('check order start');
        $orders = $this->orderModel->getOrder();
        
        $orderNotification = config('notifications.new_order');
        if ($orders->isNotEmpty() ) {
            foreach ($orders as $order) {
                $user = $this->userModel->GetAdmin();
                $deviceTokens = [$user->device_token]; 
                $orderMessage = str_replace('#ORDER_ID#', $order->code, $orderNotification['message']);

                Log::info('check',['orderMessage'=>$orderMessage]);
                
                $this->sendFirebaseNotification($deviceTokens, null, $orderNotification['title'],$orderMessage);
                
                $this->notificationModel->create([
                    "user_id" => $user->id,
                    "title" => $orderNotification['title'],
                    "message" => $orderMessage,
                    "type" => NotificationType::ORDER,
                    "read_at" => NotificationReadAt::Not_Read,
                ]);
            }
        }
      return Command::SUCCESS;
    }
}