<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Enums\Product\ProductStatus;
use App\Http\Requests\Product\ProductRequest;
use Exception;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $status = ProductStatus::asSelectArray();
        return view('product.index', compact(['products', 'status']));
    }

    public function create()
    {
        return view('product.create', [
            'status' => ProductStatus::asSelectArray(),
            'categories' => Category::all(),
            'brands' => Brand::all(), 
        ]);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->status = ProductStatus::Deleted;
        $product->save();
        return redirect()->route('admin.product.index')->with('success', 'Thực hiện thành công.');
    }

    public function store(ProductRequest $request)
    {
        try {
            $imagePath = '';
            if ($request->hasFile('images')) {
                $image = $request->file('images');

                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/product'), $fileName);
                $imagePath = '/images/product/' . $fileName;
            }

            Product::create([
                'name' => $request->name,
                'status' => $request->status,
                'slug' => $request->slug,
                'short_desc' => $request->short_desc,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'images' => $imagePath,
            ]);
            return redirect()->route('admin.product.index')->with('success', 'Thêm thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $status = ProductStatus::asSelectArray();
        return view('product.edit', [
            'product' => $product,
            'status' => $status,
            'categories' => Category::all(), 
            'brands' => Brand::all(), 
        ]);
    }

    public function update(ProductRequest $request)
    {
        $product = Product::find($request['id']);
        
        if ($request->hasFile('new_image')) {
            if ($product->images && file_exists(public_path($product->images))) {
                unlink(public_path($product->images));
            }
            $newImage = $request->file('new_image');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images/product'), $newImageName);

            $product->images = 'images/product/' . $newImageName;
        }
        $product->images = $product->images ?? $request->input('old_image');

        $product->name = $request->input('name');
        $product->status = $request->input('status');
        $product->slug = $request->input('slug');
        $product->short_desc = $request->input('short_desc');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');

        $product->save();

        return redirect()->route('admin.product.edit', $product->id)->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }
}
