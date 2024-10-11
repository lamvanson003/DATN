<?php

namespace App\Http\Controllers\Product_Variant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\Product\ProductVariantRequest;
use Exception;
use  App\Enums\Product\ProductStatus;
use App\Models\Product_Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $product = Product::with('variantColor.color')->findOrFail($product_id);
        return view('product_variant.create',
        compact('product')
        );
    }

    public function delete($product_id,$id)
    {
        $product_variant = Product_Variant::findOrFail($id);
        $product_variant->delete();
        return redirect()->route('admin.product.product_item.index',$product_id)->with('success', 'Thực hiện thành công.');
    }

    public function store(ProductVariantRequest $request)
    {
        try {
            $data = $request->validated();
            $sku = 'SKU-' . strtoupper(Str::random(3)) . '-' . random_int(100, 999);

            Product_Variant::create([
                'product_id'=> $data['product_id'],
                'sku' => $sku ,
                'price' => $data['price'],
                'storage' => $data['storage'],
                'sale' => $data['sale'],
                'memory' => $data['memory'],
                'instock' => $data['instock'],
            ]);
            Log::info('mess',['mess'=> $data]);
            return redirect()->route('admin.product.product_item.index',$data['product_id'])->with('success', 'Thêm thành công.');
        } catch (Exception $e) {
            Log::info('mess',['mess'=> $e]);
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $product_variant = Product_Variant::findOrFail($id);
        return view('product_variant.edit', [
            'product_variant' => $product_variant,
        ]);
    }

    public function update(Request $request)
    {
        $product_variant = Product_Variant::find($request['id']);
        
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
