<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Enums\Post\PostStatus;
use App\Models\PostCategory;
use App\Models\User;
use App\Http\Requests\Post\PostRequest;
use Exception;

class PostController extends Controller
{
    // Display a listing of posts
    public function index()
    {
        $posts = Post::with('category', 'user')->get(); 
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = PostCategory::all(); 
        $statuses = PostStatus::asSelectArray(); 
        $users = User::all(); 
        return view('post.create', compact('categories', 'statuses', 'users'));
    }

    public function store(Request $request)
    {
        // Post::create($request->validated()); 
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug',
            'content' => 'required|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:post_categories,id',
            'status' => 'required|in:' . implode(',', PostStatus::getValues()),
            'user_id' => 'required|exists:users,id',
            'posted_at' => 'required|date', 
        ]);
    
        $imagePath = null;
        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('post_images', 'public');
        }
    
        Post::create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'content' => $request->input('content'),
            'images' => $imagePath,
            'category_id' => $request->input('category_id'),
            'posted_at' => $request->input('posted_at') ? $request->input('posted_at') : now(), // Gán giá trị mặc định là thời gian hiện tại
            'status' => $request->input('status'),
            'user_id' => $request->input('user_id'),
        ]);
    
        return redirect()->route('admin.post.index')->with('success', 'Bài viết đã được tạo thành công.');
    }
    

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', [
            'post' => $post,
            'statuses' => PostStatus::asSelectArray(),
            'categories' => PostCategory::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'slug' => 'required|string|unique:posts,slug,' . $id,
            'images' => 'nullable|string',
            'status' => 'required|in:' . implode(',', PostStatus::getValues()),
            'category_id' => 'required|exists:post_categories,id',
        ]);

        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'content' => $request->input('content'),
            'images' => $request->input('images'),
            'status' => $request->input('status'),
            'category_id' => $request->input('category_id'),

        ]);

        return redirect()->route('admin.post.index')->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.post.index')->with('success', 'Bài viết đã được xóa thành công.');
    }
}
