<?php 
namespace App\Http\Controllers\ImageItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_Image_Item;



class ImageItem extends controller {
    public function getId($id)
    {   
        $productId = $id;
        $product = Product::findOrfail($productId);
        $product_variant = Product_Image_Item::getIdByProduct($productId);
        return view('product_variant.create', compact(['product_variant',['productId','product']]));
    }
}