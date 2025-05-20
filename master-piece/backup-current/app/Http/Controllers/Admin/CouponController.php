<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:coupons',
            'discount' => 'required|numeric|min:0|max:100',
            'max_uses' => 'required|integer|min:1',
            'expires_at' => 'required|date|after:today',
            'is_active' => 'boolean'
        ]);

        Coupon::create([
            'code' => strtoupper($request->code),
            'discount' => $request->discount,
            'max_uses' => $request->max_uses,
            'expires_at' => $request->expires_at,
            'is_active' => $request->is_active ?? true
        ]);

        return redirect()->route('admin.coupons.index')
            ->with('success', 'تم إضافة الكوبون بنجاح');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
            'discount' => 'required|numeric|min:0|max:100',
            'max_uses' => 'required|integer|min:1',
            'expires_at' => 'required|date|after:today',
            'is_active' => 'boolean'
        ]);

        $coupon->update([
            'code' => strtoupper($request->code),
            'discount' => $request->discount,
            'max_uses' => $request->max_uses,
            'expires_at' => $request->expires_at,
            'is_active' => $request->is_active ?? true
        ]);

        return redirect()->route('admin.coupons.index')
            ->with('success', 'تم تحديث الكوبون بنجاح');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')
            ->with('success', 'تم حذف الكوبون بنجاح');
    }
}
