<?php
namespace App\Http\Controllers\Api\UserOrder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\JsonResponse;
use App\Enums\User\UserRole;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class UserOrderController extends Controller {
  // API to get order details
  public function __construct()
    {
        $this->middleware('auth:sanctum'); // Ensure authentication
    }

    // API to get order details
    public function index(Request $request, $orderId)
    {
        try {
            // Find order by ID with related order details and product variants
            $order = Order::with(['orderDetails.productVariant'])
                          ->where('id', $orderId)
                          ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found',
                ], 404);
            }

            // Initialize total amount
            $totalAmount = 0;

            $orderDetails = $order->orderDetails->map(function ($orderDetail) use (&$totalAmount) {
                // Calculate the total price for this order detail (price * quantity - discount)
                $totalPrice = ($orderDetail->price - $orderDetail->sale) * $orderDetail->quantity;
                $totalAmount += $totalPrice;

                return [
                    'product_name' => $orderDetail->productVariant->name,
                    'product_image' => $orderDetail->productVariant->image,
                    'quantity' => $orderDetail->quantity,
                    'price' => $orderDetail->price,
                    'sale' => $orderDetail->sale,
                    'total_price' => $totalPrice,
                ];
            });

            // Return response with the order details and total amount
            return response()->json([
                'success' => true,
                'message' => 'Order details fetched successfully',
                'data' => [
                    'order_id' => $order->id,
                    'order_code' => $order->code,
                    'shipping_method' => $order->shipping_method,
                    'fullname' => $order->fullname,
                    'phone' => $order->phone,
                    'address' => $order->address,
                    'email' => $order->email,
                    'status' => $order->status,
                    'total_amount' => $totalAmount,
                    'order_details' => $orderDetails,
                ]
            ], 200);

        } catch (Exception $e) {
            // Log error if something goes wrong
            Log::error('Order details fetch error', [
                'error' => $e->getMessage(),
                'order_id' => $orderId,
                'request_data' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching the order details: ' . $e->getMessage(),
            ], 500); // General error response
        }
    }
}
