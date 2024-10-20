<?php 
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {   
        return view('dashboard.dashboard'); 
    }




    public function countProductInactive(){
        $q = Product::countProductInactive();
        return $q;
    }
}

