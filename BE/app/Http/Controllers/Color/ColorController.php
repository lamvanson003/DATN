<?php

namespace App\Http\Controllers\Color;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Enums\Status;
use Exception;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $color = Color::all();
        return view('color.index',compact(['color']));
    }

    public function create()
    {   
        $status = Status::asSelectArray();
        return view('color.create',compact(['status']));
    }

    public function delete($id)
    {
        $color = Color::findOrFail($id);
        $color->delete();
        return redirect()->route('admin.color.index')->with('success', 'Thực hiện thành công.');
    }

    public function store(Request $request)
    {
        try {
            $imagePath = '';
            if ($request->hasFile('images')) {
                $images = $request->file('images');

                $fileName = time() . '_' . $images->getClientOriginalName();
                $images->move(public_path('images/color'), $fileName);
                $imagePath = 'http://127.0.0.1:8000/images/color/' . $fileName;
            }
            Color::create([
                'color' => $request['color'],
                'images' => $imagePath,
            ]);
            return redirect()->route('admin.color.index')->with('success', 'Thêm thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $color = Color::findOrFail($id);
        return view('color.edit', [
            'color' => $color,
        ]);
    }

    public function update(Request $request)
    {
        $color = Color::find($request['id']);
        
        if ($request->hasFile('new_image')) {
            if ($color->images && file_exists(public_path($color->images))) {
                unlink(public_path($color->images));
            }
            $newImage = $request->file('new_image');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images/color'), $newImageName);

            $color->images = 'images/color/' . $newImageName;
        }
        $color->images = $color->images ?? $request->input('old_image');

        $color->name = $request->input('name');

        $color->save();

        return redirect()->route('admin.color.edit', $color->id)->with('success', 'Cập nhật thành công!');
    }
}
