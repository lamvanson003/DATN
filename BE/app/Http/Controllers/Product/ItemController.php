<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Enums\Status;
use App\Models\Product_Image_Item;
use App\Models\Product_Variant;
use Exception;



class ItemController extends controller
{
    public function index($product_id)
    {   
        $product = Product::with('product_image_items')->findOrFail($product_id);
        $product_image_item = $product->product_image_items;
        $status = Status::asSelectArray();
        return view('product_image_item.index', compact(
            'product',
            'product_image_item',
            'status'
        ));
    }

    public function create($id)
    {
        $productId = $id;
        $product = Product::findOrFail($productId);
        $status = Status::asSelectArray();
        return view('product_image_item.create', compact(['product', 'status']));
    }

    public function store(Request $request)
    {
        try {
            $baseUrl = url()->to('/');
            $imagePath = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/product_image_item'), $fileName);
                $imagePath =  $baseUrl . '/images/product_image_item/' . $fileName;
            }

            Product_Image_Item::create([
                'name' => $request->name,
                'description' => $request->description,
                'product_id' => $request->product_id,
                'image' => $imagePath,
            ]);
            return redirect()->route('admin.product.item.index', $request->product_id)->with('success', 'Thêm thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $status = Status::asSelectArray();
        $product_image_item = Product_Image_Item::with('product')->findOrFail($id);
        return view('product_image_item.edit', compact(['product_image_item', 'status']));
    }

    public function update(Request $request)
    {   
        $request->validate([
            'id' => 'required|exists:product_image_items,id', 
            'name' => 'required|string|max:255', 
            'status' => 'required|integer', 
            'description' => 'nullable|string', 
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' 
        ]);

        $baseUrl = url()->to('/');
        $product_image_item = Product_Image_Item::findOrFail($request['id']);

        if ($request->hasFile('new_image')) {
            if ($product_image_item->image && file_exists(public_path($product_image_item->image))) {
                unlink(public_path($product_image_item->image));
            }
            $newImage = $request->file('new_image');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images/product'), $newImageName);

            $product_image_item->image = $baseUrl . '/images/product/' . $newImageName;
        }

        $product_image_item->update([
            'name' => $request['name'],
            'status' => $request['status'],
            'description' => $request['description'],
            'image' => $product_image_item->image ?? $request->input('old_image'),
        ]);

        return redirect()->back()->with('success', 'Item đã được cập nhật thành công!');
    }


    public function delete($product_id, $id)
    {
        $items = Product_Image_Item::findOrFail($id);
        $items->delete();
        return redirect()->route('admin.product.item.index', $product_id)->with('success', 'Thực hiện thành công');
    }
}
