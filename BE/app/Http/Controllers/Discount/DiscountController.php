<?php

namespace App\Http\Controllers\Discount;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Enums\Discount\DiscountStatus;
use App\Enums\Discount\DiscountType;
use App\Http\Requests\Discount\DiscountRequest;
use Illuminate\Http\Request;
use Exception;
use Carbon\Carbon;

class DiscountController extends Controller
{
    public function checkAndExpireDiscounts()
    {
        $now = Carbon::now();

        Discount::where('status', DiscountStatus::Active)
            ->where('date_end', '<', $now)
            ->update(['status' => DiscountStatus::Expired]);
    }

    public function index()
    {
        $this->checkAndExpireDiscounts();
        $discounts = Discount::where('status', DiscountStatus::Active)->get();
        return view('discount.index', compact('discounts'));
    }

    public function inactive()
    {
        $discounts = Discount::whereIn('status', [
            DiscountStatus::Inactive,
            DiscountStatus::Expired,
            DiscountStatus::Used,
            DiscountStatus::Deleted
        ])->get();
        return view('discount.inactive', compact('discounts'));
    }

    public function create()
    {
        $types = DiscountType::asSelectArray();
        $status = DiscountStatus::asSelectArray();
        return view('discount.create', compact('types', 'status'));
    }

    public function store(DiscountRequest $request)
    {
        try {
            $data = $request->validated();

            $data['type'] = (int) $data['type'];
            $data['status'] = (int) $data['status'];

            if ($data['type'] === DiscountType::Percent && $data['discount_value'] > 99) {
                return redirect()->back()->withErrors(['discount_value' => 'Giá trị giảm giá không được lớn hơn 99% cho loại giảm giá phần trăm.'])->withInput();
            }
            if ($data['type'] === DiscountType::Fixed && $data['discount_value'] <= 0) {
                return redirect()->back()->withErrors(['discount_value' => 'Giá trị giảm giá cố định phải lớn hơn 0.'])->withInput();
            }

            if (!in_array($data['type'], array_keys(DiscountType::asSelectArray()))) {
                return redirect()->back()->withErrors(['type' => 'Loại giảm giá không hợp lệ.']);
            }

            if (!in_array($data['status'], array_keys(DiscountStatus::asSelectArray()))) {
                return redirect()->back()->withErrors(['status' => 'Trạng thái không hợp lệ.']);
            }

            Discount::create([
                'code' => $data['code'],
                'discount_value' => $data['discount_value'],
                'type' => $data['type'],
                'desc' => $data['desc'],
                'amount' => $data['amount'], // Thêm trường amount
                'date_start' => Carbon::parse($data['date_start']),
                'date_end' => Carbon::parse($data['date_end']),
                'status' => $data['status'],
            ]);

            return redirect()->route('admin.discount.index')->with('success', 'Thêm mã giảm giá thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        $types = DiscountType::asSelectArray();
        $status = DiscountStatus::asSelectArray();
        return view('discount.edit', compact('discount', 'types', 'status'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'code' => 'required|string|max:255',
                'discount_value' => 'required|numeric',
                'type' => 'required|in:' . implode(',', array_keys(DiscountType::asSelectArray())),
                'desc' => 'nullable|string|max:255',
                'amount' => 'required|integer|min:0', // Validate amount
                'date_start' => 'required|date',
                'date_end' => 'required|date|after_or_equal:date_start',
                'status' => 'required|in:' . implode(',', array_keys(DiscountStatus::asSelectArray())),
            ]);

            $discount = Discount::findOrFail($id);

            $data = $request->all();
            $data['type'] = (int) $data['type'];
            $data['status'] = (int) $data['status'];

            if ($data['type'] === DiscountType::Percent && $data['discount_value'] > 99) {
                return redirect()->back()->withErrors(['discount_value' => 'Giá trị giảm giá không được lớn hơn 99% cho loại giảm giá phần trăm.'])->withInput();
            }
            if ($data['type'] === DiscountType::Fixed && $data['discount_value'] <= 0) {
                return redirect()->back()->withErrors(['discount_value' => 'Giá trị giảm giá cố định phải lớn hơn 0.'])->withInput();
            }

            $discount->update([
                'code' => $data['code'],
                'discount_value' => $data['discount_value'],
                'type' => $data['type'],
                'desc' => $data['desc'],
                'amount' => $data['amount'], // Thêm trường amount
                'date_start' => Carbon::parse($data['date_start']),
                'date_end' => Carbon::parse($data['date_end']),
                'status' => $data['status'],
            ]);

            return redirect()->route('admin.discount.index')->with('success', 'Cập nhật mã giảm giá thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $discount = Discount::findOrFail($id);

            $discount->update([
                'status' => DiscountStatus::Deleted,
            ]);

            return redirect()->route('admin.discount.index')->with('success', 'Cập nhật trạng thái mã giảm giá thành "Đã xóa" thành công.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
