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
        return view('category.index', compact(['category']));
    }
    public function create()
    {
        return view(
            'category.create',
            ['status' => CategoryStatus::asSelectArray()]
        );
    }

    public function delete($id)
    {
        $category = Category::findOrfail($id);
        $category->status = CategoryStatus::Deleted;
        $category->save();
        return redirect()->route('admin.category.index')->with('success', 'Thực hiện thành công.');
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
                'slug' => $request->slug,
                'images' => $imagePath,
            ]);

            return redirect()->route('admin.category.index')->with('success', 'Thêm thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view(
            'category.edit',
            ['category' => $category],
            ['status' => CategoryStatus::asSelectArray()]
        );
    }

    public function update(CategoryRequest $request)
    {   
        $category = Category::find($request['id']);


        if ($request->hasFile('new_image')) {
            if ($category->images && file_exists(public_path($category->images))) {
                unlink(public_path($category->images));
            }
            $newImage = $request->file('new_image');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images/category'), $newImageName);

            $category->images = 'images/category/' . $newImageName;
        }
        $category->images = $category->images ?? $request->input('old_image');

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->status = $request->input('status');
        $category->slug = $request->input('slug');

        $category->save();

        return redirect()->route('admin.category.edit', $category->id)->with('success', 'Danh mục đã được cập nhật thành công!');
    }
}
