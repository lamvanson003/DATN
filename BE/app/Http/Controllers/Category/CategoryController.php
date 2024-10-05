<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Enums\Category\CategoryStatus;
use App\Http\Requests\Category\CategoryRequest;
use Illuminate\Http\Request;
use Exception;
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
        try {
            $imagePath = '';
            if ($request->hasFile('images')) {
                $image = $request->file('images');
    
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/category'), $fileName);
                $imagePath = '/images/category/' . $fileName;
            }
    
            Category::create([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'images' => $imagePath,
            ]);
    
            return redirect()->route('admin.category.index')->with('success', 'Thêm thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
       
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        
        return view('category.edit',
        ['category'=> $category],
        ['status' =>CategoryStatus::asSelectArray()]);
    }

    public function update(CategoryRequest $request)
    {   
        try {
            $category = Category::findOrFail($request['id']); 
            $data = $request->validated();  
           
            if ($request->hasFile('images')) {
                $imageName = time() . '.' . $request->images->extension();
                $request->images->move(public_path('/images/category'), $imageName);
                $imagePath = '/images/category/' . $imageName;
                $data['images'] = $imagePath;
                dd(111111);
                if ($category->images) {
                    $oldImagePath = public_path('/images/category/' . $category->images);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            } else {
                $data['images'] = $category->images;
            }
            dd($data);
            $category->update($data);
            
            return redirect()->back()->with('success', 'Danh mục đã được sửa thành công.');
        } catch (Exception $e) 
        {
            return redirect()->back()->with('error','Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    
    
}
