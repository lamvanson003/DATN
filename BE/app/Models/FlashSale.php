<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ActiveStatus;
use Carbon\Carbon;

class FlashSale extends Model
{
    use HasFactory;
    protected $table = "flash_sales";
    protected $fillable = ['start_time','end_time','status'];


    public function saleItems(){
        return $this->hasMany(SaleItem::class);
    }

    protected $casts = [
        'status' => ActiveStatus::class,
    ];

    public function getFlashSaleExpired(){
        $now = Carbon::now();
        return FlashSale::with('saleItems')->where('end_time', '<', $now)->get();
    }
    
}
