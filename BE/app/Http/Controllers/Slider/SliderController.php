<?php

namespace App\Http\Controllers\Slider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\SliderRequest;
use App\Models\Slider;
use App\Models\SliderItem;
use App\Enums\Status;
use App\Enums\Slider\SliderStatus;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::with('slider_items')->get();
        $status = SliderStatus::asSelectArray();
        return view('slider.index', compact(['sliders', 'status']));
    }

    public function create()
    {
        return view('slider.create', [
            'status' => Status::asSelectArray(),
        ]);
    }

    public function delete($id)
    {
        $sliders = Slider::findOrFail($id);
        $sliders->status = SliderStatus::Deleted;
        $sliders->save();
        return redirect()->route('admin.slider.index')->with('success', 'Thực hiện thành công.');
    }
    
    public function store(SliderRequest $request)
    {
        try {
            $data = $request->validated();
            $baseUrl = url()->to('/');
            $imagePath = '';

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/slider'), $fileName);
                $imagePath = $baseUrl . '/images/slider/' . $fileName;
            }

            $slider = Slider::create([
                'name' => $data['name'],
                'desc' => $data['desc'],
                'status' => $data['status'],
                'image' => $imagePath,
            ]);

            if ($request->hasFile('image_items')) {
                foreach ($request->file('image_items') as $image_item) {
                    $fileName = time() . '_' . $image_item->getClientOriginalName(); 
                    $image_item->move(public_path('images/slider_item'), $fileName);
                    $image_itemsPath = $baseUrl . '/images/slider_item/' . $fileName;

                    SliderItem::create([
                        'slider_id' => $slider->id,
                        'images' => $image_itemsPath,
                    ]);
                }
            }

            return redirect()->route('admin.slider.index')->with('success', 'Thêm slider thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        $status = SliderStatus::asSelectArray();
        return view('slider.edit', compact('slider', 'status'));
    }

    public function update(SliderRequest $request)
    {
        $slider =  Slider::find($request['id']);

        if ($request->hasFile('new_image')) {
            if ($slider->image && file_exists(public_path($slider->image))) {
                unlink(public_path($slider->image));
            }
            $newImage = $request->file('new_image');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images/slider'), $newImageName);

            $slider->image = 'http://127.0.0.1:8000/images/slider/' . $newImageName;
        }
        $slider->image = $slider->image ?? $request->input('old_image');
        $slider->name = $request->input('name');
        $slider->status = $request->input('status');
        $slider->desc = $request->input('desc');

        $slider->save();

        return redirect()->route('admin.slider.index', $slider->id)->with('success', 'Slider đã được cập nhật thành công!');
    }
}
