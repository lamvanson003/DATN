<?php 
namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\OrderDetail;
use Illuminate\Http\JsonResponse;
use App\Enums\User\UserRole;
use App\Models\ProductVariant;

use Illuminate\Support\Facades\DB;

class CommentController extends Controller {


    public function create(Request $request){
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'product_variant_id' => 'required|integer',
            'content' => 'required|string',
            'rating' => 'required|integer',
        ]);
        try {
            DB::beginTransaction();
            $comment = Comment::create([
                'user_id' => $validatedData['user_id'],
                'product_variant_id' => $validatedData['product_variant_id'],
                'content' => $validatedData['content'],
                'rating' => $validatedData['rating'],
                'status' => CommentStatus::Pending,
            ]);
            
            DB::commit();
            return response()->json(['message' => 'Comments created successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create Comments', 'details' => $e->getMessage()], 500);
        }
    }
}
