<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerSearchSelectController extends Controller
{
    /**
     * Tìm kiếm khách hàng cho Select2
     */
    public function selectSearch(Request $request)
    {
        $query = $request->input('q', ''); // Lấy từ khóa tìm kiếm nếu có

        // Trả về tất cả khách hàng nếu không có từ khóa tìm kiếm
        $customers = User::query()
            ->where('roles', '=', 2)
            ->where(function ($q) use ($query) {
                if ($query) {
                    $q->where('fullname', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%");
                }
            })
            ->limit(10)
            ->get(['id', 'fullname', 'phone']); // Lấy id, fullname và phone của khách hàng

        return response()->json($customers->map(function ($customer) {
            return [
                'id' => $customer->id,
                'text' => $customer->fullname, 
                'phone' => $customer->phone, 
            ];
        }));
    }



}
