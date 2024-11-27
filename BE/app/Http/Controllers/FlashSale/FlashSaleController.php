<?php

namespace App\Http\Controllers\FlashSale;

use App\Enums\Product\ProductStatus;
use App\Enums\ActiveStatus;
use App\Http\Controllers\Controller;
use App\Models\SaleItem;
use App\Models\ProductVariant;
use App\Enums\DefaultStatus;
use App\Models\FlashSale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Http\Requests\FlashSale\FlashSaleRequest;

class FlashSaleController extends Controller
{
    public function index()
    {
        $status = ProductStatus::asSelectArray();
        $saleItems = SaleItem::with('flashSale', 'product_variant')->get();
        return view('flash_sales.index', compact(['status', 'saleItems']));
    }


    public function create()
    {
        $productVariants = ProductVariant::where('status', DefaultStatus::Active)
        ->where('is_flash_sale',false)
        ->get();
        $status = ActiveStatus::asSelectArray();
        return view('flash_sales.create', compact('status', 'productVariants'));
    }

    public function store(FlashSaleRequest $request)
    {
        $data = $request->validated();

        $startTime = Carbon::parse($data['start_time'])->toDateTimeString();
        $endTime = Carbon::parse($data['end_time'])->toDateTimeString();

        DB::beginTransaction();

        try {
            $flashSale = FlashSale::create([
                'start_time' => $startTime,
                'end_time' => $endTime,
                'status' => DefaultStatus::Active,
            ]);

            $flashSaleId = $flashSale->id;


            if (Carbon::parse($request->start_time)->lessThan(Carbon::now())) {

                return redirect()->route('admin.flashSale.create')
                ->with('error',"Thời gian bắt đầu phải lớn hơn thời gian hiện tại.");
            }

            foreach ($data['selected_variants'] as $variantId) {
                $discountPrice = $data['discount_price'][$variantId] ?? null;
                $quantityLimit = $data['quantity_limit'][$variantId] ?? null;

                if ($quantityLimit < 0 || $quantityLimit > 127) { 
                    return redirect()->route('admin.flashSale.create')->with('error',"Sản phẩm vượt quá giới hạn cho phép.");
                }

                if ($data['instock'] < $quantityLimit) { 
                    return redirect()->route('admin.flashSale.create')->with('error',"Số lượng sản phẩm không đủ.");
                }
                if ($discountPrice === null || $quantityLimit === null) {
                    continue;
                }

                if (is_array($discountPrice) || is_array($quantityLimit)) {
                    return redirect()->route('admin.flashSale.create')->with('error','Số lượng không đủ để Sale');
                }

                SaleItem::create([
                    'flash_sale_id' => $flashSaleId,
                    'product_variant_id' => $variantId,
                    'discount_price' => $discountPrice,
                    'quantity_limit' => $quantityLimit,
                    'is_active' => $data['is_active'],
                ]);

                $variantIds[] = $variantId;        
            }

            ProductVariant::whereIn('id', $variantIds)->update(['is_flash_sale' => true]);
            DB::commit();

            return redirect()->route('admin.flashSale.index')->with('success', 'Flash sale created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Error: ' . $e->getMessage());
        }
    }

    public function updateProductVariant($productVariantId){
        $productVariant = ProductVariant::findOrfail($productVariantId);
        $productVariant->is_flash_sale = true;
        $productVariant->save();
    }

    public function edit($id)
    {
        // $status = ProductStatus::asSelectArray();
        $status = ActiveStatus::asSelectArray();
        $saleItem = SaleItem::with('product_variant.product')->findOrFail($id);
    
        return view('flash_sales.edit', compact('status', 'saleItem'));
    }
    
    public function delete($id)
    {
        $saleItem = SaleItem::with('product_variant.product')->findOrFail($id);
        $saleItem->delete();

        return redirect()->route('admin.flashSale.index')->with('success', 'Xóa flash sale thành công.');
    }
    
    public function update(FlashSaleRequest $request, $id)
    {
        $data = $request->validated();
    
        DB::beginTransaction();
        try {
            $saleItem = SaleItem::findOrFail($id);
    
            $saleItem->discount_price = $data['discount_price'];
            $saleItem->quantity_limit = $data['quantity_limit'];
            $saleItem->is_active = $data['is_active'];
    
            $saleItem->save();
    
            DB::commit();
            return redirect()->route('admin.flashSale.index')->with('success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Cập nhật SaleItem thất bại: ' . $e->getMessage());
            return back()->withErrors('Đã có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    
    
}
