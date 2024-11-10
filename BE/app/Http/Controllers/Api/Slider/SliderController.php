<?php

namespace App\Http\Controllers\Api\Slider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\SliderItem;
use App\Enums\Status;
use App\Enums\Slider\SliderStatus;

class SliderController extends Controller
{
    //
    public function index (){
        try {
            $sliders = Slider::with(
                [
                'slider_items'
                ]
            )->where('status', SliderStatus::Active)->get();
            return response()->json([
                'success' => true,
                'data' => $sliders
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch data',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
