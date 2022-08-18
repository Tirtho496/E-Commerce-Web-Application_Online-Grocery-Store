<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::where('user_id',Auth::id())->get();
        $user = User::where('id',Auth::id())->first();
        $points = $user->points;
        $coupon = Coupon::where('points','<=',$points)->get();
        return view('home',compact('orders','coupon','user'));
    }
    
    public function viewThisOrder($id)
    {
        $order = Order::find($id);
        $orderItems = OrderItem::where('order_id',$id)->get();
        return view('frontend/viewOrder',compact('order','orderItems'));
    }

    public function deleteorder($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect('home')->with('status','Order Cancelled Successfully');
    }

    public function redeem($id)
    {
        $coupon = Coupon::find($id);
        $user = User::where('id',Auth::id())->first();
        if($user->coupon_id)
        {
            return redirect('home')->with('status','Please use previous coupon first');
        }
        $user->coupon_id = $id;
        $user->points = $user->points - $coupon->points;
        $user->save();
        return redirect('home')->with('status',$coupon->code.' Coupon Redeemed Successfully');
    }

}
