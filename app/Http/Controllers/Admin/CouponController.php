<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupon = Coupon::all();

        return view('admin.coupon.index', compact('coupon'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'coupon_code' => 'required|unique:coupons,coupon_code,except,id',
            'discount' => 'required',
            'usage_limit' => 'required',

        ]);

        Coupon::create([
            'coupon_code' => $request->coupon_code,
            'discount' => $request->discount,
            'usage_limit' => $request->usage_limit,

        ]);

        return redirect()->route('admin.coupon-index')->with('toast_success', 'Coupon Berhasil Di Tambahkan');

    }
    public function update(Request $request)
    {

        Coupon::where('id', $request->id)->update([
            'coupon_code' => $request->coupon_code,
            'discount' => $request->discount,
            'usage_limit' => $request->usage_limit,

        ]);
        return redirect()->route('admin.coupon-index')->with('toast_success', 'Coupon Berhasil Di Ubah');
    }

    public function delete($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->route('admin.coupon-index')->with('toast_success', 'Coupon Berhasil Di Hapus');
    }
}
