<?php

namespace App\Http\Controllers\Product_Variant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\Product\ProductVariantRequest;
use Exception;
use  App\Enums\Product\ProductStatus;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Logger\ConsoleLogger;

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
        $storages = ['64GB', '128GB', '256GB', '512GB' ,'1T'];
        return view('product_variant.create',
        compact('product','storages')
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
        return view('product_variant.edit', [
            'product_variant' => $product_variant,
            
        ]);
    }

    public function update(Request $request)
    {
        $product_variant = ProductVariant::find($request['id']);
        
        $product_variant->update([
            'memory' => $request->input('memory'),
            'price' => $request->input('price'),
            'sale' => $request->input('sale'),
            'instock' => $request->input('instock'),
            'storage' => $request->input('storage'),
        ]);

        return redirect()->back()->with('success', 'Cập nhật thành công!');
    }
}
