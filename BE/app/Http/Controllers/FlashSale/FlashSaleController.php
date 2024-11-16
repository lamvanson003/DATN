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
        $productVariants = ProductVariant::where('status', DefaultStatus::Active)->get();
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
                'end_time' =>  $endTime,
                'status' => DefaultStatus::Active,
            ]);
            $flashSaleId = $flashSale->id;
            foreach ($data['selected_variants'] as $variantId) {
                $discountPrice = $data['discount_price'][$variantId] ?? null;
                $quantityLimit = $data['quantity_limit'][$variantId] ?? null;
                if ($discountPrice === null || $quantityLimit === null) {
                    continue;
                }

                if (is_array($discountPrice) || is_array($quantityLimit)) {
                    throw new \Exception('Discount price or quantity limit should not be an array');
                }

                SaleItem::create([
                    'flash_sale_id' => $flashSaleId,
                    'product_variant_id' => $variantId,
                    'discount_price' => $discountPrice,
                    'quantity_limit' => $quantityLimit,
                    'is_active' => $data['is_active'],
                ]);
            }

            DB::commit();

            return redirect()->route('admin.flashSale.index')->with('success', 'Flash sale created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors('Error: ' . $e->getMessage());
        }
    }
}
