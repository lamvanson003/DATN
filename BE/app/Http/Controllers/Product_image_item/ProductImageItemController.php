<?php 
namespace App\Http\Controllers\Product_image_item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Enums\Status;
use App\Models\Product_Image_Item;
use Exception;



class ProductImageItemController extends controller {
    public function imageItem($id)
    {   
        $productId = $id;
        $product = Product::findOrFail($productId);
        $product_image_item = Product_Image_Item::imageItemByProduct($productId);
        return view('product_image_item.index', compact(['product_image_item','product']));
    }

    public function create($id)
    {   
        $productId = $id;
        $product = Product::findOrFail($productId);
        return view('product_image_item.create', compact(['product']));
    }

    public function store(Request $request)
    {   
        try {
            $imagePath = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/product_image_item'), $fileName);
                $imagePath = 'http://127.0.0.1:8000/images/product_image_item/' . $fileName;
            }

            Product_Image_Item::create([
                'name' => $request->name,
                'description' => $request->description,
                'product_id' => $request->product_id,
                'image' => $imagePath,
            ]);
            return redirect()->route('admin.product_image_item.imageItem',$request->product_id)->with('success', 'Thêm thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {   
        $product_image_item = Product_Image_Item::findOrFail($id);
        return view('product_image_item.edit', compact(['product_image_item']));
    }

    public function update(Request $request)
    {
        $product_image_item = Product_Image_Item::find($request['id']);
        
        if ($request->hasFile('new_image')) {
            if ($product_image_item->images && file_exists(public_path($product_image_item->images))) {
                unlink(public_path($product_image_item->images));
            }
            $newImage = $request->file('new_image');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images/product'), $newImageName);

            $product_image_item->images = 'http://127.0.0.1:8000/images/product/' . $newImageName;
        }
        $product_image_item->images = $product_image_item->images ?? $request->input('old_image');

        $product_image_item->name = $request->input('name');
        $product_image_item->status = $request->input('status');
        $product_image_item->slug = $request->input('slug');
        $product_image_item->short_desc = $request->input('short_desc');
        $product_image_item->description = $request->input('description');
        $product_image_item->category_id = $request->input('category_id');
        $product_image_item->brand_id = $request->input('brand_id');

        $product_image_item->save();

        return redirect()->route('admin.product_image_item.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }
}