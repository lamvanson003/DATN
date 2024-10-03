<?php

namespace App\Admin\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    //
    public function index(){
        return to_route('admin.dashboard');
    }
}
