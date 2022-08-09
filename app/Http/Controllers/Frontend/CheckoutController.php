<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){

        // $cartItems = Cart::where('user_id',Auth::id())->get();
        // foreach($cartItems as $item)
        // {
        //     if(!(Product::where('id',$item->product_id)->where('qty','>=', $item->product_qty)->exists()))
        //     {
        //         $removed = Cart::where('user_id',Auth::id())->where('product_id',$item->product_id)->first();
        //         $removed->delete();
        //     }
        // }
        $newcartItems = Cart::where('user_id',Auth::id())->get();

        return view('frontend.checkout',compact('newcartItems'));
    }

    public function placeOrder(Request $request)
    {
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->phone = $request->input('phone');
        $order->email = $request->input('email');
        $order->address = $request->input('address');
        $order->city = $request->input('city');
        $order->district= $request->input('district');
        $order->division = $request->input('division');
        $total = 0;

        $cart_total = Cart::where('user_id',Auth::id())->get();
        foreach($cart_total as $item)
        {
            $total += $item->products->price*$item->product_qty;
        }
        

        $user = User::where('id',Auth::id())->first();
        if($user->coupon->type == 0)
        {
            $total = $total- ($user->coupon->value);
        }
        else
        {
            $total =  floor($total- ($user->coupon->percent_off*$total/100));
        }

        $order->total_price = $total;

        $order->tracking_no = 'trk'.time().rand(1111,9999);
        $order->save();

        $order->id;

        $cartItems = Cart::where('user_id',Auth::id())->get();
        foreach($cartItems as $item)
        {
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->product_id,
                'qty' => $item->product_qty,
                'price' => $item->products->price,
            ]);

            $product = Product::where('id',$item->product_id)->first();
            $product->qty = $product->qty- $item->product_qty;
            $product->update();
        }

        $cartItems = Cart::where('user_id',Auth::id())->get();
        Cart::destroy($cartItems);

        return redirect('/')->with('status',"Order Placed Successfully");


    }
}
