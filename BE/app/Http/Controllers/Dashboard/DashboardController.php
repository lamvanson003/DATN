<?php 
namespace App\Http\Controllers\Dashboard;

use App\Enums\User\UserRole;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Subcription;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {   
        $countUser = $this->countUser();
        $countProduct = $this->countProduct();
        $countSubcription = $this->countSubcription();
        $countOrder = $this->countOrder();

        $getUser = $this->getUserDash();
        return view('dashboard.dashboard',
        compact(
            'countUser',
            'countProduct',
            'countSubcription',
            'countOrder',

            'getUser'
        )
        ); 
    }



    public function countUser(){
        $q = User::count();
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

    










}

