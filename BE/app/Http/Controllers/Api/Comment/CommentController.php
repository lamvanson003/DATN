<?php 
namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Enums\Comment\CommentStatus;
use App\Http\Resources\Api\Comment\CommentResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller {


    public function create(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string',
            'product_variant_id' => ['required','exists:App\Models\ProductVariant,id'],
            'content' => 'required|string',
            'rating' => 'nullable|integer',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg', 
        ]);
        try {
            DB::beginTransaction();

            $baseUrl = url()->to('/');
            $imagePath = [];
           if (!empty($validatedData['images'])) {
                foreach ($validatedData['images'] as $image) {
                    $fileName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images/comment'), $fileName);
                    $imagePath[] = $baseUrl . '/images/comment/' . $fileName;
                }
            }
            Comment::create([
                'fullname' => $validatedData['name'],
                'product_variant_id' => $validatedData['product_variant_id'],
                'content' => $validatedData['content'],
                'images' =>  json_encode($imagePath) ?? null, 
                'rating' => $validatedData['rating'],
                'status' => CommentStatus::Pending,
            ]);
            
            DB::commit();
            return response()->json(['message' => 'Comments created successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating comment: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create Comments', 'details' => $e->getMessage()], 500);
        }
    }


    public function index($product_variant_id){
       
        try {
            $comments = Comment::where('product_variant_id', $product_variant_id)
            ->where('status',CommentStatus::Approved)
            ->get();
            return response()->json([
                'success' => true,
                'data' => CommentResource::collection($comments)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch comments',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}