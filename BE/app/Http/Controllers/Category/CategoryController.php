<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Enums\Category\CategoryStatus;
use App\Http\Requests\Category\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {   
        $category = Category::category();
        $status = CategoryStatus::asSelectArray();
        return view('category.index',compact(['category']));
    }
    public function create()
    {   
        return view('category.create',
        ['status' =>CategoryStatus::asSelectArray()]);
    }


    public function store(CategoryRequest $request)
{        
    $imagePath = '';
    if ($request->hasFile('images')) {
        // Lưu hình ảnh và lấy đường dẫn
        $imagePath = $request->file('images')->store('images/category', 'public'); 
    }

    // Tạo đối tượng Category
    Category::create([
        'name' => $request->name,
        'description' => $request->description,
        'status' => $request->status,
        'images' => $imagePath, // Lưu đường dẫn hình ảnh vào DB
    ]); 

    return redirect()->route('admin.category.index')->with('success', 'Danh mục đã được thêm thành công.');
}


}
