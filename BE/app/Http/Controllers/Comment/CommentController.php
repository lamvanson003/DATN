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
  
    public function index($type)
    {       
        if($type === 'productVariant'){
            $comments = Comment::with('productVariant')
            ->whereNotNull('product_variant_id')
            ->orderBy('created_at','desc')
            ->get(); 
        } elseif ($type === 'post') {
            $comments = Comment::with('post')
                ->whereNotNull('post_id')
                ->orderBy('created_at', 'desc')
                ->get();
        }  
        return view('comment.index', compact('comments', 'type')); 
    }

    
    public function update(Request $request)
    {       
        $comment = Comment::findOrFail($request->input('id')); 
        $comment->status = CommentStatus::Approved;
        $comment->save();
        return redirect()->back()->with('success', 'Thực hiện thành công.');
    }

   
           
        public function delete($id)
        {
            $comment = Comment::findOrFail($id); 
            $comment->delete(); 
            return redirect()->back()->with('success', 'Thực hiện thành công.');
        }

}
