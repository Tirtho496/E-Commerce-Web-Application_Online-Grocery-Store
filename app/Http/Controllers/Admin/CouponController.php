<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function index()
    {
        $coupon = Coupon::all();
        return view('admin.coupon.index',compact('coupon'));
    }

    public function add()
    {

        return view('admin.coupon.add');
    }

    public function insert(Request $request)
    {
        $coupon= new Coupon();

        $coupon->code = $request->input('code');
        $coupon->type = $request->input('type') == TRUE?'1':'0';
        $coupon->value = $request->input('value');
        $coupon->percent_off = $request->input('percent_off');
        $coupon->points = $request->input('points');
        
        $coupon->save();
        return redirect('view-coupons')->with('status','Coupon Added Successfully');


    }

    public function delete($id)
    {
        $coupon = Coupon::find($id);
        
        $coupon->delete();
        return redirect('view-coupons')->with('status','Coupon Deleted Successfully');
    }

}
