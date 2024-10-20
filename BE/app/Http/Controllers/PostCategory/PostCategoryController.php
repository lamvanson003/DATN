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
    // Display a listing of post categories
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

    // Store a newly created post category
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
            // Lưu hình ảnh vào thư mục 'post_category_images' trong thư mục public/storage
            $imagePath = $request->file('images')->store('post_category_images', 'public'); 
        }

        // Tạo mới danh mục bài viết
        PostCategory::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'images' => $imagePath, // Lưu đường dẫn ảnh
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

    // Update an existing post category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:post_categories,slug,' . $id,
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Cho phép cập nhật ảnh mới
            'status' => 'required|in:' . implode(',', PostCategoryStatus::getValues()),
        ]);

        $postCategory = PostCategory::findOrFail($id);

        $imagePath = $postCategory->images; // Giữ nguyên ảnh cũ
        if ($request->hasFile('images')) {
            // Lưu ảnh mới nếu có
            $imagePath = $request->file('images')->store('post_category_images', 'public');
        }

        $postCategory->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'images' => $imagePath, // Cập nhật lại đường dẫn ảnh
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.post_category.index')->with('success', 'Danh mục bài viết được cập nhật thành công.');
    }

    // Delete a post category
    public function delete($id)
    {
        $postCategory = PostCategory::findOrFail($id);
        $postCategory->delete();
        return redirect()->route('admin.post_category.index')->with('success', 'Danh mục bài viết được xóa thành công');
    }
}
