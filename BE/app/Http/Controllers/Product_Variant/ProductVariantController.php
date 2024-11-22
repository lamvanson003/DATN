<?php

namespace App\Http\Controllers\Product_Variant;

use App\Enums\DefaultStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductVariantRequest;
use Exception;
use App\Enums\Status;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImageItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductVariantController extends Controller
{
    public function index($product_id)
    {   
        $product = Product::with('product_variant')->findOrFail($product_id);
        $product_variant = $product->product_variant;
        return view('product_variant.index', compact('product_variant','product'));
    }

    public function create($product_id)
    {  
        $product = Product::findOrFail($product_id);
        $status = DefaultStatus::asSelectArray();
        $storages = ['64GB', '128GB', '256GB', '512GB' ,'1T'];
        return view('product_variant.create',
        compact('product','storages','status')
        );
    }

    public function delete($product_id,$id)
    {
        $product_variant = ProductVariant::findOrFail($id);
        $product_variant->delete();
        return redirect()->route('admin.product.product_item.index',$product_id)->with('success', 'Thực hiện thành công.');
    }

    public function store(ProductVariantRequest $request)
    {
        try {
            $data = $request->validated();
            $baseUrl = url()->to('/');
            if ($request->has('variants')) {
                foreach ($request->input('variants') as $key => $variant) {
                    
                    $variantImagePath = null;
                    if ($request->hasFile("variants.$key.image_color")) {
                        $variantImage = $request->file("variants.$key.image_color");
                        $fileName = time() . '_' . $variantImage->getClientOriginalName(); 
                        $variantImage->move(public_path('images/variant_images'), $fileName);
                        $variantImagePath = $baseUrl . '/images/variant_images/' . $fileName;
                    }
    
                    $sku = 'SKU-'. random_int(10, 9999);
                    ProductVariant::create([
                        'sku' =>   $sku,
                        'product_id' => $data['product_id'],
                        'storage' => $variant['storage'],
                        'price' => $variant['price'],
                        'sale' => $variant['sale'],
                        'memory' => $variant['memory']??null,
                        'instock' => $variant['instock'],
                        'images' => $variantImagePath,
                        'color' => $variant['color'],
                    ]);
                }
            } 
            return redirect()->route('admin.product.product_item.index',$data['product_id'])->with('success', 'Thêm thành công.');
        } catch (Exception $e) {
            Log::info('mess',['mess'=> $e]);
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit($product_id,$id)
    {   
        $product_variant = ProductVariant::with('product')->findOrFail($id);
        $status = Status::asSelectArray();
        return view('product_variant.edit', [
            'product_variant' => $product_variant,
            'status' => $status,
        ]);
    }

    public function update(Request $request)
    {   
        $product_variant = ProductVariant::find($request['id']);
        $baseUrl = url()->to('/');

        if ($request->hasFile('new_image')) {
            if ($product_variant->images && file_exists(public_path('images/variant_images/' . basename($product_variant->images)))) {
                unlink(public_path('images/variant_images/' . basename($product_variant->images)));
            }
            $newImage = $request->file('new_image');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images/variant_images'), $newImageName);

            $product_variant->images = $baseUrl . '/images/variant_images/' . $newImageName;
        }

        $product_variant->images = $product_variant->images ?? $request->input('old_image');
        
        $product_variant->update([
            'memory' => $request->input('memory'),
            'price' => $request->input('price'),
            'sale' => $request->input('sale'),
            'instock' => $request->input('instock'),
            'storage' => $request->input('storage'),
            'images' => $product_variant->images,
        ]);
        return redirect()->route('admin.product.product_item.index', $request['product_id'])->with('success', 'Thực hiện thành công');
    }
}
