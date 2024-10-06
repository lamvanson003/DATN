<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Enums\Brand\BrandStatus;
use App\Http\Requests\Brand\BrandRequest;
use Exception;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $status = BrandStatus::asSelectArray();
        return view('brand.index', compact(['brands', 'status']));
    }

    public function create()
    {
        return view('brand.create', ['status' => BrandStatus::asSelectArray()]);
    }

    public function delete($id)
    {
        $brand = Brand::findOrfail($id);
        $brand->status = BrandStatus::Deleted;
        $brand->save();
        return redirect()->route('admin.brand.index')->with('success', 'Thực hiện thành công.');
    }

    public function store(BrandRequest $request)
    {
        try {
            $imagePath = '';
            if ($request->hasFile('images')) {
                $image = $request->file('images');

                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/brand'), $fileName);
                $imagePath = '/images/brand/' . $fileName;
            }

            Brand::create([
                'name' => $request->name,
                'status' => $request->status,
                'slug' => $request->slug,
                'images' => $imagePath,
            ]);
            return redirect()->route('admin.brand.index')->with('success', 'Thêm thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        $status = BrandStatus::asSelectArray();
        return view('brand.edit', compact('brand', 'status'));
    }

    public function update(BrandRequest $request)
    {

        $brand = Brand::find($request['id']);
        
        if ($request->hasFile('new_image')) {
            if ($brand->images && file_exists(public_path($brand->images))) {
                unlink(public_path($brand->images));
            }
            $newImage = $request->file('new_image');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images/brand'), $newImageName);

            $brand->images = 'images/brand/' . $newImageName;
        }
        $brand->images = $brand->images ?? $request->input('old_image');

        $brand->name = $request->input('name');
        $brand->status = $request->input('status');
        $brand->slug = $request->input('slug');

        $brand->save();

        return redirect()->route('admin.brand.edit', $brand->id)->with('success', 'Danh mục đã được cập nhật thành công!');
    }
}
