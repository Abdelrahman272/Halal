<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::paginate();
        return view('admin.coupons.index', compact('coupons'));
    }


    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(CouponRequest $request)
    {
        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->discount_amount = $request->discount_amount;
        $coupon->discount_type = $request->discount_type;
        $coupon->max_uses = $request->max_uses;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->save();

        return redirect()->route('coupon.index')->with('success', 'Coupon created successfully');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(CouponRequest $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->code = $request->code;
        $coupon->discount_amount = $request->discount_amount;
        $coupon->discount_type = $request->discount_type;
        $coupon->max_uses = $request->max_uses;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->update();

        return redirect()->route('coupon.index')->with('success', 'Coupon updated successfully');
    }


    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('coupon.index')->with('success', 'Coupon deleted successfully');
    }
}
