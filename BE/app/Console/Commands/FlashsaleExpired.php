<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\Traits\NotifiesViaFirebase;
use App\Enums\Notification\{NotificationReadAt, NotificationType};
use App\Models\FlashSale;
use App\Models\User;
use App\Models\SaleItem;
use App\Models\Notification;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class FlashsaleExpired extends Command
{

    use NotifiesViaFirebase;

    protected FlashSale $flashsale;
    protected SaleItem $saleItem;
    protected User $user;
    protected Notification $notificationModel;

    public function __construct(
        FlashSale $flashsale,
        SaleItem $saleItem,
        User $user,
        Notification $notificationModel
    ) {
        parent::__construct();
        $this->flashsale = $flashsale;
        $this->saleItem = $saleItem;
        $this->user = $user;
        $this->notificationModel = $notificationModel;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashsale:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if user have join flashsale on time and notifies them if not.';


    /**
     * Execute the console command.
     *
     * @return int
     * @throws Exception
     */
    public function handle(): int
    {   
        try {
            DB::transaction(function () {
                Log::info('check flashsale expired start');
                $flashsales = $this->flashsale->getFlashSaleExpired();
                Log::info('check flashsale', ['flashsale' => $flashsales]);
                $flashsaleExpired = config('notifications.flashsale_expired');
        
                if ($flashsales->isNotEmpty()) {
                    $users = $this->user->GetAdminDeviceToken();
                    $deviceTokens = $users->pluck('device_token')->filter()->toArray();
        
                    if (!empty($deviceTokens)) {
                        $ids = $flashsales->pluck('id')->toArray();
                        $count = $flashsales->count();
        
                        $checkFlashsaleMessage = str_replace('#FLASHSALE_EXPIRED_COUNT#', $count, $flashsaleExpired['message']);
                        Log::info('checkFlashsaleMessage', ['checkFlashsaleMessage' => $checkFlashsaleMessage]);    
        
                        $this->sendFirebaseNotification($deviceTokens, null, $flashsaleExpired['title'], $checkFlashsaleMessage);
        
                        foreach ($users as $user) {
                            $this->notificationModel->create([
                                "user_id" => $user->id,
                                "title" => $flashsaleExpired['title'],
                                "message" => $checkFlashsaleMessage,
                                "type" => NotificationType::UPDATED,
                                "read_at" => NotificationReadAt::Not_Read,
                            ]);
                        }
        
                        $this->updateSaleItem($ids);
                        $this->flashsale->whereIn('id', $ids)->delete();
                    } else {
                        Log::warning('No admin with device_token found.');
                    }
                }
            });
            return Command::SUCCESS;
        } catch (\Throwable $th) {
            Log::error('Caught exception: ' . $th->getMessage());
            throw $th;
        }
        
    }

    public function updateSaleItem($ids)
    {
        $saleItems = SaleItem::with('product_variant')->whereIn('flash_sale_id', $ids)->get();
        
        foreach ($saleItems as $saleItem) {
            if ($saleItem->product_variant) {
                $saleItem->product_variant->increment('instock', $saleItem->quantity_limit);
                $saleItem->product_variant->is_flash_sale = false;
                $saleItem->product_variant->save();
            }
        }
       
    }
}
