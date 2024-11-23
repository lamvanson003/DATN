<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User; 
use App\Models\ProductVariant; 
use Illuminate\Http\Request;
use App\Enums\Comment\CommentStatus; 
use App\Http\Requests\Comment\CommentRequest; 
use Exception;

class CommentController extends Controller
{
  
    public function index()
    {
        $comments = Comment::with('productVariant')->get(); 
        return view('comment.index', compact('comments')); 
    }

    
    public function create()
    {
        $users = User::all(); 
        $products = ProductVariant::all(); 
        return view('comment.create', [
            'statuses' => CommentStatus::asSelectArray(),
            'users' => $users,
            'products' => $products
        ]); 
    }

    // Hiển thị form sửa comment
    public function edit($id)
    {
        $comment = Comment::findOrFail($id); 
        $statuses = CommentStatus::asSelectArray();
        return view('comment.edit', [
            'comment' => $comment,
            'statuses' => CommentStatus::asSelectArray(), 
      
        ]);
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:255', 
            'status' => 'required|in:' . implode(',', CommentStatus::getValues()), 
            'rating' => 'required|integer|between:1,5', 
        ]);

        $comment = Comment::findOrFail($id); 
    $comment->update([
        'content' => $request->input('content'), 
        'status' => $request->input('status'), 
        'rating' => $request->input('rating'),
    ]);

        return redirect()->route('admin.comment.index')->with('success', 'Comment updated successfully.');
    }

   
           
        public function delete($id)
        {
            $comment = Comment::findOrFail($id); 
            $comment->delete(); 
            return redirect()->route('admin.comment.index')->with('success', 'Comment deleted successfully.');
        }

}
