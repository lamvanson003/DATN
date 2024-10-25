<?php

namespace App\Http\Controllers\PostCategory;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Enums\PostCategory\PostCategoryStatus;
use App\Http\Requests\PostCategory\PostCategoryRequest; 
use Exception;

class PostCategoryController extends Controller
{
    public function index()
    {
        $postCategories = PostCategory::all();
        return view('post_category.index', compact('postCategories'));
    }

    public function create()
    {
        return view('post_category.create', [
            'statuses' => PostCategoryStatus::asSelectArray(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:post_categories,slug',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'status' => 'required|in:' . implode(',', PostCategoryStatus::getValues()),
        ]);

        $imagePath = null;
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/post_category'), $imageName);  
            $imagePath = 'images/post_category/' . $imageName;  
        }

        PostCategory::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'images' => $imagePath, 
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.post_category.index')->with('success', 'Danh mục bài viết đã được tạo thành công.');
    }

    public function edit($id)
    {
        $postCategory = PostCategory::findOrFail($id);
        return view('post_category.edit', [
            'postCategory' => $postCategory,
            'statuses' => PostCategoryStatus::asSelectArray(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:post_categories,slug,' . $id,
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'status' => 'required|in:' . implode(',', PostCategoryStatus::getValues()),
        ]);

        $postCategory = PostCategory::findOrFail($id);

        $imagePath = $postCategory->images; 
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/post_category'), $imageName);  
            $imagePath = 'images/post_category/' . $imageName;  
        }

        $postCategory->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'images' => $imagePath, 
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.post_category.index')->with('success', 'Danh mục bài viết được cập nhật thành công.');
    }

    public function delete($id)
    {
        $postCategory = PostCategory::findOrFail($id);
        $postCategory->delete();
        return redirect()->route('admin.post_category.index')->with('success', 'Danh mục bài viết được xóa thành công');
    }
}
