<?php 
namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Enums\User\UserRole;
use App\Enums\Order\OrderStatus;
use App\Models\Product;
use App\Models\User;
use App\Models\Subcription;
use App\Models\Order;
use App\Models\ProductVariant;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {   
        $countUser = $this->countUser();
        $getTotalpriceOrder = $this->getTotalpriceOrder();
        $countProduct = $this->countProduct();
        $countSubcription = $this->countSubcription();
        $countOrder = $this->countOrder();

        $getUser = $this->getUserDash();
        $getOrder = $this->getOrderDash();

        $orderRevenue = $this->getOrderRevenueByMonth();
        $userRegistration = $this->getUserRegistrationByMonth();
        $orderCount = $this->getOrderCountByMonth();
        $productCounts  = $this->getProductCountByCategory();
        

        return view('dashboard.dashboard', [
            'getTotalpriceOrder' => $getTotalpriceOrder,
            'countUser' => $countUser,
            'countProduct' => $countProduct,
            'countSubcription' => $countSubcription,
            'countOrder' => $countOrder,
            'getUser' => $getUser,
            'getOrder' => $getOrder,
            'orderRevenue' => $orderRevenue,
            'userRegistration' => $userRegistration,
            'orderCount' => $orderCount,
            'productCounts' => $productCounts,
        ]);
    }
    
    public function countUser(){
        $q = User::where('roles',UserRole::User)->count();
        return $q;
    }

    public function countProduct(){
        $q = Product::count();
        return $q;
    }
    public function countSubcription(){
        $q = Subcription::count();
        return $q;
    }
    public function countOrder(){
        $q = Order::count();
        return $q;
    }

    public function getUserDash(){
        $q = User::where('roles',UserRole::User)
        ->orderBy('id','desc')->limit(10)->get();
        return $q;
    }

    public function getTotalpriceOrder(){
        $q = Order::where('completed',true)
        ->sum('total_price');
        return $q;
    }

    public function getOrderDash(){
        $q = Order::orderBy('id','desc')
        ->where('status',OrderStatus::Pending) 
        ->orwhere('status',OrderStatus::Completed) 
        ->limit(10)->get();
        return $q;
    }

    public function getOrderRevenueByMonth(){
        $orderRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total_revenue')
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at) ASC')
            ->get();
    
        $revenueData = array_fill(0, 12, 0);
        $labels = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
        
        foreach ($orderRevenue as $revenue) {
            $month = $revenue->month - 1;
            $revenueData[$month] = $revenue->total_revenue;
        }
    
        return [
            'revenueData' => $revenueData,
            'labels' => $labels,
        ];
    }
    
    public function getUserRegistrationByMonth(){
        $userRegistration = User::selectRaw('MONTH(created_at) as month, COUNT(id) as total_users')
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at) ASC')
            ->get();
    
        $userData = array_fill(0, 12, 0);
        $labels = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
        
        foreach ($userRegistration as $registration) {
            $month = $registration->month - 1;
            $userData[$month] = $registration->total_users;
        }
    
        return [
            'userData' => $userData,
            'labels' => $labels,
        ];
    }
    
    public function getOrderCountByMonth(){
        $orderCount = Order::selectRaw('MONTH(created_at) as month, COUNT(id) as total_orders')
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at) ASC')
            ->get();
    
        $orderData = array_fill(0, 12, 0);
        $labels = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
        
        foreach ($orderCount as $order) {
            $month = $order->month - 1;
            $orderData[$month] = $order->total_orders;
        }
    
        return [
            'orderData' => $orderData,
            'labels' => $labels,
        ];
    }

    public function getProductCountByCategory()
    {
        $productCounts = Product::selectRaw('category_id, COUNT(id) as total')
            ->whereIn('category_id', [1, 2])
            ->groupBy('category_id')
            ->pluck('total', 'category_id')
            ->toArray(); // Chuyển thành mảng
    
        return [
            'labels' => ['Điện thoại', 'Laptop'],
            'counts' => array_values($productCounts), // Lấy giá trị (5, 10)
        ];
    }
    
}

