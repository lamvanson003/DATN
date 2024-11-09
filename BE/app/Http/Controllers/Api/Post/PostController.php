<?php
namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Enums\Post\PostStatus;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('categories', 'user')->get();
        return response()->json($posts);
    }

    public function detail($slug)
    {
        $post = Post::with('categories', 'user')->where('slug', $slug)->first();
    
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
    
        return response()->json($post);
    }
    

    public function postsByCategory($slug)
    {
        // Tìm danh mục theo slug
        $category = PostCategory::where('slug', $slug)->first();
    
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    
        // Lấy các bài viết thuộc danh mục này thông qua bảng trung gian
        $posts = $category->posts()->with('categories', 'user')->get();
    
        return response()->json($posts);
    }
    


}
