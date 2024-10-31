<?php 
namespace App\Http\Controllers\Dashboard;

use App\Enums\User\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Subcription;
use App\Models\Order;
use App\Enums\Order\OrderStatus;

class DashboardController extends Controller
{
    public function index()
    {   
        $countUser = $this->countUser();
        $countProduct = $this->countProduct();
        $countSubcription = $this->countSubcription();
        $countOrder = $this->countOrder();

        $getUser = $this->getUserDash();
        $getOrder = $this->getOrderDash();
        
        $countUser = $this->countUser();
        $countProduct = $this->countProduct();
        $countSubcription = $this->countSubcription();
        $countOrder = $this->countOrder();

        $dataPoints = [
            ["label" => "Người dùng", "y" => $countUser],
            ["label" => "Sản phẩm", "y" => $countProduct],
            ["label" => "Đăng ký", "y" => $countSubcription],
            ["label" => "Đơn hàng", "y" => $countOrder],
        ];

        return view('dashboard.dashboard',
        compact(
            'countUser',
            'countProduct',
            'countSubcription',
            'countOrder',

            'getUser',
            'getOrder',
            'dataPoints'
        )
        ); 
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

    public function getOrderDash(){
        $q = Order::orderBy('id','desc')
        ->where('status',OrderStatus::Pending) 
        ->orwhere('status',OrderStatus::Completed) 
        ->limit(10)->get();
        return $q;
    }
}

