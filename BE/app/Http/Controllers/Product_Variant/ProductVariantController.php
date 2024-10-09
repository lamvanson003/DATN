<?php

namespace App\Http\Controllers\Product_Variant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_Variant;
use App\Http\Requests\Product\ProductVariantRequest;
use Exception;

class ProductVariantController extends Controller
{
    public function index()
    {
        $product_variant = Product_Variant::all();
        return view('product_variant.index', compact(['product_variant']));
    }
    public function getId($id)
    {   
        $productId = $id;
        $product = Product::findOrfail($productId);
        $product_variant = Product_Variant::getIdByProduct($productId);
        return view('product_variant.create', compact(['product_variant',['productId','product']]));
    }

    public function create()
    {
        return view('product_variant.create');
    }

    // public function delete($id)
    // {
    //     $product = Product::findOrFail($id);
    //     $product->status = ProductStatus::Deleted;
    //     $product->save();
    //     return redirect()->route('admin.product.index')->with('success', 'Thực hiện thành công.');
    // }

    public function store(ProductVariantRequest $request)
    {
        try {
            
            $sku = 'NO.'.random_int(1,50).range(1,10,3);

            Product::create([
                'sku ' => $sku ,
                'price' => $request->price,
                'sale' => $request->sale,
                'memory' => $request->memory,
                'in_stock' => $request->in_stock,
                'color' => $request->in_stock,
            ]);
            return redirect()->route('admin.product.index')->with('success', 'Thêm thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    // public function edit($id)
    // {
    //     $product = Product::findOrFail($id);
    //     $status = ProductStatus::asSelectArray();
    //     return view('product.edit', [
    //         'product' => $product,
    //         'status' => $status,
    //         'categories' => Category::all(), 
    //         'brands' => Brand::all(), 
    //     ]);
    // }

    // public function update(ProductRequest $request)
    // {
    //     $product = Product::find($request['id']);
        
    //     if ($request->hasFile('new_image')) {
    //         if ($product->images && file_exists(public_path($product->images))) {
    //             unlink(public_path($product->images));
    //         }
    //         $newImage = $request->file('new_image');
    //         $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
    //         $newImage->move(public_path('images/product'), $newImageName);

    //         $product->images = 'images/product/' . $newImageName;
    //     }
    //     $product->images = $product->images ?? $request->input('old_image');

    //     $product->name = $request->input('name');
    //     $product->status = $request->input('status');
    //     $product->slug = $request->input('slug');
    //     $product->short_desc = $request->input('short_desc');
    //     $product->description = $request->input('description');
    //     $product->category_id = $request->input('category_id');
    //     $product->brand_id = $request->input('brand_id');

    //     $product->save();

    //     return redirect()->route('admin.product.edit', $product->id)->with('success', 'Sản phẩm đã được cập nhật thành công!');
    // }
}
