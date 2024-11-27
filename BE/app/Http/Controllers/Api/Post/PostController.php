<?php
namespace App\Http\Controllers\Api\Post;

use App\Enums\Is_featured;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Enums\Post\PostStatus;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Http\Resources\Api\Post\PostResourceCollection;
use App\Http\Resources\Api\Post\PostResource;
use App\Http\Resources\Api\Post\PostCateResourceCollection;

class PostController extends Controller
{
    public function index()
    {   
        try {
            $post = Post::with('categories', 'user')->where('status', PostStatus::Active)->get();
            
            return response()->json([
                'success' => true,
                'data' => PostResourceCollection::collection($post)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch data post',
                'error' => $th->getMessage()
            ], 500);
        }

    }

    public function postFeatured()
    {   
        try {
            $post = Post::with('categories', 'user')
            ->where('status', PostStatus::Active)
            ->where('is_featured', Is_featured::Is_featured)
            ->get();

            return response()->json([
                'success' => true,
                'data' => PostResourceCollection::collection($post)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch data post',
                'error' => $th->getMessage()
            ], 500);
        }

    }
    
    public function category()
    {   
        try {
            $post = PostCategory::where('status', PostStatus::Active)
            ->get();

            return response()->json([
                'success' => true,
                'data' => PostCateResourceCollection::collection($post)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch data post',
                'error' => $th->getMessage()
            ], 500);
        }

    }



    public function detail($slug)
    {
        try {
            $post = Post::with('categories', 'user')->where('slug', $slug)->get();

            return response()->json([
                'success' => true,
                'data' => PostResource::collection($post)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch data post',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    

    public function postsByCategory($slug)
    {
        $category = PostCategory::where('slug', $slug)->first();
    
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $posts = $category->posts()->with('categories', 'user')->get();
    
        return response()->json($posts);
    }
    


}
