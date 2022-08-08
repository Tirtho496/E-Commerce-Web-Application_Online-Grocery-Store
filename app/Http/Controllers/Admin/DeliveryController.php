<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{
    public function index()
    {   
        
        return view('admin.delivery.delivery');
    }

    public function update(Request $request)
    {
        $trk = $request->input('tracking');
        $ord = Order::where('tracking_no',$trk)->get();
        $ord = $ord[0];
        
        
        if($ord->status == 0)
        {
            $ord->status = $request->input('shipped') == TRUE?'1':'0';
        }
        else if($ord->status == 1)
        {
            $ord->status = $request->input('delivered') == TRUE?'2':'1';
        }

        $ord->update();
        return redirect('/dashboard')->with('status','Delivery Status Updated Successfully');
    }
}
