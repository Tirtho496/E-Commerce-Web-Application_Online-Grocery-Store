<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::where('status','2')->get();
        $pending = Order::where('status','<','2')->get();
        return view('admin.index',compact('orders','pending'));
    }
}   
