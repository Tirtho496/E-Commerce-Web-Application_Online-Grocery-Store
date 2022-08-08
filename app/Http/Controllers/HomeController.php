<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        return view('home',compact('orders'));
    }
    
    public function viewThisOrder($id)
    {
        $order = Order::find($id);
        $orderItems = OrderItem::where('order_id',$id)->get();
        return view('frontend/viewOrder',compact('order','orderItems'));
    }
}
