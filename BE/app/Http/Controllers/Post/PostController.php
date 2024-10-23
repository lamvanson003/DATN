<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Enums\Post\PostStatus;
use App\Models\PostCategory;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('categories', 'user')->get();  
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
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug',
            'content' => 'required|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'category_id' => 'required|array',
            'category_id.*' => 'exists:post_categories,id',
            'status' => 'required|in:' . implode(',', PostStatus::getValues()),
            'user_id' => 'required|exists:users,id',
            'posted_at' => 'required|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/post/'), $imageName);  
            $imagePath = 'images/post/' . $imageName; 
        }
    
        $post = Post::create([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'content' => $request->input('content'),
            'images' => $imagePath,
            'posted_at' => $request->input('posted_at'),
            'status' => $request->input('status'),
            'user_id' => $request->input('user_id'),
        ]);

        $post->categories()->sync($request->input('category_id')); 
    
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
            'slug' => 'required|string|unique:posts,slug,' . $id,
            'content' => 'required|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'status' => 'required|in:' . implode(',', PostStatus::getValues()),
            'category_id' => 'required|array',
            'category_id.*' => 'exists:post_categories,id',
        ]);

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/post/'), $imageName);  
            $post->images = 'images/post/' . $imageName;  
        }

        $post->update([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
        ]);

        $post->categories()->sync($request->input('category_id'));

        return redirect()->route('admin.post.index')->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.post.index')->with('success', 'Bài viết đã được xóa thành công.');
    }
}
