<?php 
namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Enums\DefaultStatus;

class WarehouseController extends Controller{
    public function variant(){
        $variant = ProductVariant::orderBy('instock', 'asc')->get();
        $status = DefaultStatus::asSelectArray();
        return view('warehouse.variant',compact('variant','status'));
    }
}