<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

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
}
