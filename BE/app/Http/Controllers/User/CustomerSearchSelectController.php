<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Enums\User\UserRole;

class CustomerSearchSelectController extends Controller
{
    /**
     * Tìm kiếm khách hàng cho Select2
     */
    public function selectSearch(Request $request)
    {
        try {
            $query = $request->get('q', '');
            $showAll = filter_var($request->get('show_all', false), FILTER_VALIDATE_BOOLEAN); 
    
            $customers = User::query();

            $customers->where('roles', UserRole::User);

            if (!$showAll) {
                if (!empty($query)) {
                    $customers->where(function ($q) use ($query) {
                        $q->where('fullname', 'like', '%' . $query . '%')
                          ->orWhere('phone', 'like', '%' . $query . '%');
                    });
                }
            }
    
            $results = $customers->limit(50)->get();
    
            return response()->json($results->map(function ($customer) {
                return [
                    'id' => $customer->id,
                    'text' => $customer->fullname,
                ];
            }));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }
    
}




