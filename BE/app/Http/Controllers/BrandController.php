<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Enums\Brand\BrandStatus;
use App\Http\Requests\Brand\BrandRequest;

class BrandController extends Controller
{
    public function index()
    {   
        $brands = Brand::all();
        $status = BrandStatus::asSelectArray();
        return view('brand.index',compact(['brands', 'status']));
    }
    
    public function create()
    {   
        return view('brand.create', ['status' => BrandStatus::asSelectArray()]);

    }

    public function store(BrandRequest $request)
    {        
        $imagePath = '';
        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('images/category', 'public'); 
        }

        Brand::create([
            'name' => $request->name,
            'images' => $imagePath, 
            'slug' => $request->description,
            'status' => $request->status,
        ]); 

        return redirect()->route('admin.brand.index')->with('success', 'Danh mục đã được thêm thành công.');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        $status = BrandStatus::asSelectArray();
        return view('brand.edit', compact('brand', 'status'));
    }

    // Phương thức cập nhật thương hiệu
    public function update(BrandRequest $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $imagePath = $brand->images; // Giữ hình ảnh hiện tại nếu không có hình ảnh mới

        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('images', 'public');
        }

        $brand->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'images' => $imagePath,
        ]);

        return redirect()->route('admin.brand.index')->with('success', 'Thương hiệu đã được cập nhật thành công.');
    }
}
