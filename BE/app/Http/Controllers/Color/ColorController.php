<?php

namespace App\Http\Controllers\Color;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\VariantColor;
use App\Enums\Status;
use Exception;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $color = Color::all();
        $status = Status::asSelectArray();
        return view('color.index',compact(['color','status']));
    }

    public function create()
    {   
        $status = Status::asSelectArray();
        return view('color.create',compact(['status']));
    }

    public function storeByVariant(Request $request){
        $color = Color::create([
            'name' => $request['name'],
        ]);
        VariantColor::create([
            'product_variant_id' =>  $request['product_variant_id'],
            'color_id' =>  $color->id
        ]);
        return redirect()->route('admin.product.edit',$request['product_id'])->with('success', 'Thực hiện thành công.');
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
            $baseUrl = url()->to('/');
            $imagePath = '';
            if ($request->hasFile('images')) {
                $images = $request->file('images');

                $fileName = time() . '_' . $images->getClientOriginalName();
                $images->move(public_path('images/color'), $fileName);
                $imagePath = $baseUrl.'/images/color/' . $fileName;
            }
            Color::create([
                'name' => $request['name'],
                'images' => $imagePath,
            ]);
            return redirect()->back()->with('success', 'Thêm thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $color = Color::findOrFail($id);
        $status = Status::asSelectArray();
        return view('color.edit', [
            'color' => $color,
            'status' => $status
        ]);
    }

    public function update(Request $request)
    {   
        $color = Color::findOrfail($request['id']);
      
        $baseUrl = url()->to('/');
        if ($request->hasFile('new_image')) {
            if ($color->images && file_exists(public_path($color->images))) {
                unlink(public_path($color->images));
            }
            $newImage = $request->file('new_image');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('/images/color'), $newImageName);

            $color->images = $baseUrl.'/images/color/' . $newImageName;
        }
        $color->images = $color->images ?? $request->input('old_image');
        $color->status = $request->input('status');
        $color->name = $request->input('name');
        $color->save();

        return redirect()->route('admin.color.edit', $color->id)->with('success', 'Cập nhật thành công!');
    }
}
