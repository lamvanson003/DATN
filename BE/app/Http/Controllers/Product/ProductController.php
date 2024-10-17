<?php

namespace App\Http\Controllers\Product;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Enums\Product\ProductStatus;
use App\Enums\Status;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product_Variant;
use App\Models\VariantColor;
use App\Models\ProductImageItem;
use App\Models\ProductVariant;
use Exception;
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('product_image_items','product_variant')->get();
        $status = ProductStatus::asSelectArray();
        return view('product.index', compact(['products', 'status']));
    }

    public function create()
    {
        
        $categories = Category::where('status', ProductStatus::Active)->get();
        $brands = Brand::where('status', ProductStatus::Active)->get();
        $colors = Color::where('status', Status::Active)->get();
        return view('product.create', [
            'status' => Status::asSelectArray(), 
            'categories' => $categories, 
            'brands' => $brands,
            'colors' => $colors,
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
        $data = $request->validated();

        $baseUrl = url()->to('/');
        $imagePath = '';

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/product'), $fileName);
            $imagePath = $baseUrl . '/images/product/' . $fileName;
        }
     
        $product = Product::create([
            'name' => $data['name'],
            'status' => $data['status'],
            'slug' => $data['slug'],
            'short_desc' => $data['short_desc'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'brand_id' => $data['brand_id'],
            'images' => $imagePath,
        ]);

        if ($request->hasFile('image_items')) {
            foreach ($request->file('image_items') as $image_item) {
                $fileName = time() . '_' . $image_item->getClientOriginalName(); 
                $image_item->move(public_path('images/product_image_item'), $fileName);
                $image_itemsPath = $baseUrl . '/images/product_image_item/' . $fileName; 

                ProductImageItem::create([
                    'product_id' => $product->id,
                    'images' => $image_itemsPath,
                ]);
            }
        }

        $sku = 'SKU-'. random_int(100, 999);
        $productVariant = ProductVariant::create([
            'sku' =>   $sku,
            'product_id' => $product->id,
            'storage' => $data['storage'],
            'price' => $data['price'],
            'sale' => $data['sale'],
            'memory' => $data['memory'],
            'instock' => $data['instock'],
        ]);

        if (isset($data['color']) && is_array($data['color'])) {
            foreach ($data['color'] as $color_id) {
                VariantColor::create([
                    'product_variant_id' => $productVariant->id,
                    'color_id' => $color_id,
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Thêm thành công.');
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
    }
}


    public function edit($id)
    {
        $product = Product::with('category','brand','product_variant','product_image_items')->findOrFail($id);
        $status = ProductStatus::asSelectArray();
        $product_image_item = $product->product_image_items;
        $product_variant = $product->product_variant;
        $categories = Category::where('status', ProductStatus::Active)->get();
        $brands = Brand::where('status', ProductStatus::Active)->get();

        return view('product.edit', [
            'product' => $product,
            'product_image_item' => $product_image_item,
            'status' => $status,
            'categories' => $categories, 
            'brands' => $brands, 
            'product_variant' => $product_variant, 
        ]);
    }

    public function update(ProductRequest $request)
    {   
        $data = $request->validated();
        $product = Product::findOrfail($data['id']);
        $baseUrl = url()->to('/');
        if ($request->hasFile('new_image')) {
            if ($product->images && file_exists(public_path($product->images))) {
                unlink(public_path($product->images));
            }
            $newImage = $request->file('new_image');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images/product'), $newImageName);

            $product->images = $baseUrl.'/images/product/' . $newImageName;
        }
        $product->images = $product->images ?? $request->input('old_image');

        $product->update([
            'name' => $data['name'],
            'images' => $product->images,
            'status' => $data['status'],
            'slug' => $data['slug']??$product->slug,
            'short_desc' => $data['short_desc'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'brand_id' => $data['brand_id'],
        ]);
        return redirect()->route('admin.product.edit', $product->id)->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }
}
