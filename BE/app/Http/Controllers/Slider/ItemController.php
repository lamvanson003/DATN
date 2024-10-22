<?php

namespace App\Http\Controllers\Slider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SliderItem;
use App\Enums\Status;
use Exception;



class ItemController extends Controller
{
    public function index($slider_id)
    {   
        $slider = Slider::with('slider_items')->findOrFail($slider_id);
        $slider_image_item = $slider->slider_items;
        $status = Status::asSelectArray();
        return view('slider_image_item.index', compact(
            'slider',
            'slider_image_item',
            'status'
        ));
    }

    public function create($id)
    {
        $slider_id = $id;
        $slider = Slider::findOrFail($slider_id);
        $status = Status::asSelectArray();
        return view('slider_image_item.create', compact(['slider', 'status']));
    }

    public function store(Request $request, $slider_id)
    {
        try {
            $baseUrl = url()->to('/');
            $imagePath = '';
            if ($request->hasFile('images')) {
                $images = $request->file('images');

                $fileName = time() . '_' . $images->getClientOriginalName();
                $images->move(public_path('images/slider_image_item'), $fileName);
                $imagePath =  $baseUrl . '/images/slider_image_item/' . $fileName;
            }

            $posittion = $request->input('posittion');
            
            SliderItem::create([
                'title' => $request->title,
                'slider_id' => $slider_id,
                'posittion' => $posittion,
                'images' => $imagePath,
            ]);
            return redirect()->route('admin.slider.item.index',$slider_id)->with('success', 'Thêm thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function delete($slider_id, $id)
    {
        $items = SliderItem::findOrFail($id);
        $items->delete();
        return redirect()->route('admin.slider.item.index', $slider_id)->with('success', 'Thực hiện thành công');
    }

    public function edit($id)
    {
        $slider_image_item = SliderItem::with('slider')->findOrFail($id);
        return view('slider_image_item.edit', compact(['slider_image_item']));
    }

    public function update(Request $request)
    {       
        $request->validate([
            'id' => 'required|exists:slider_items,id',
            'title' => 'required|string|max:255',
            'posittion' => 'nullable|integer',
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'old_image' => 'nullable|string',
        ]);
        
        $slider_image_item = SliderItem::findOrFail($request['id']);
        $baseUrl = url()->to('/');

        if ($request->hasFile('new_image')) {
            if ($slider_image_item->images && file_exists(public_path('images/slider/' . basename($slider_image_item->images)))) {
                unlink(public_path('images/slider/' . basename($slider_image_item->images)));
            }
            $newImage = $request->file('new_image');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images/slider'), $newImageName);

            $slider_image_item->images = $baseUrl . '/images/slider/' . $newImageName;
        }

        $slider_image_item->posittion = $request['posittion'];

        $slider_image_item->update([
            'title' => $request['title'],
            'images' => $slider_image_item->images,
        ]);

        return redirect()->route('admin.slider.item.index', ['slider_id' => $slider_image_item->slider_id])->with('success', 'Item đã được cập nhật thành công!');
    }
}
