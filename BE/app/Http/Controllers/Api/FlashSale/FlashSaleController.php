<?php
namespace App\Http\Controllers\Api\FlashSale;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\FlashSale\FlashSaleResource;
use App\Models\SaleItem;
use Carbon\Carbon;
use App\Enums\Status;
use Illuminate\Support\Facades\Log;

class FlashSaleController extends Controller
{   
    public function flashSaleActive(){
       
        try {
            $now = Carbon::now();
            $activeSaleItems = SaleItem::whereHas('flashSale', function ($query) use ($now) {
                $query->where('start_time', '<=', $now)
                      ->where('end_time', '>=', $now);
            })->where('quantity_limit', '>' , 0) 
              ->where('is_active', Status::Active) 
              ->orderBy('id','desc')
              ->get();
            return response()->json([
                'success' => true,
                'data' => FlashSaleResource::collection($activeSaleItems)
            ]);
    
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch data',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function flashSalePending(){
       
        try {
            $now = Carbon::now();
            $pendindSaleItems = SaleItem::whereHas('flashSale', function ($query) use ($now) {
                $query->where('start_time', '>', $now);
            })->where('is_active', Status::Active) 
            ->orderBy('id','desc')
              ->get();
            return response()->json([
                'success' => true,
                'data' => FlashSaleResource::collection($pendindSaleItems)
            ]);
    
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch data',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}