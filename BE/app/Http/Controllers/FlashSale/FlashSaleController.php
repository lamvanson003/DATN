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
        $productVariants = ProductVariant::where('status', DefaultStatus::Active)->get();
        $status = ActiveStatus::asSelectArray();
        return view('flash_sales.create', compact('status', 'productVariants'));
    }

    public function store(FlashSaleRequest $request)
    {
        $data = $request->validated();
        dd($data);
        $selectedVariants = $data['selected_variants'];
        $discountPrices = $data['discount_price'] ?? ['price'];
        $quantityLimits = $data['quantity_limit'] ?? [];
        $isActive = $data['is_active'];
        DB::beginTransaction();

        try {
            $flashSale = FlashSale::create([
                'is_active' => $isActive,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($selectedVariants as $index => $variantId) {
                $variant = ProductVariant::findOrFail($variantId);
                $variant->flash_sales()->attach($flashSale->id, [
                    'discount_price' => $discountPrices[$variantId] ?? 0,
                    'quantity_limit' => $quantityLimits[$index] ?? 1,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.flash_sale.index')->with('success', 'Flash sale created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors('Error: ' . $e->getMessage());
        }
    }
}
