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
    
    public function show($id) {
        try {
            $slider = Slider::with('slider_items')
                ->where('id', $id)
                ->where('status', SliderStatus::Active)
                ->first();
    
            if (!$slider) {
                $slider = Slider::with('slider_items')
                    ->where('status', SliderStatus::Active)
                    ->first();
            }
    
            if (!$slider) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không có slider nào hoạt động.'
                ], 404);
            }
    
            $sliderItems = $slider->slider_items()
                ->orderByRaw('position IS NULL, position ASC')
                ->orderBy('id', 'ASC')
                ->get();
    
            return response()->json([
                'success' => true,
                'slider' => $slider
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
