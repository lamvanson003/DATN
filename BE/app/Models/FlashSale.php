<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;
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
        'status' => Status::class,
    ];

    public function getFlashSaleExpired(){
        $now = Carbon::now();
        return FlashSale::with('saleItems')->where('end_time', '<', $now)->get();
    }
    
}