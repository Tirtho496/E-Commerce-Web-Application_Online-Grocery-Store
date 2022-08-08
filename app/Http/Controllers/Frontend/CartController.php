<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');


        if(Auth::check())
        {
            $product = Product::where('id',$product_id)->first();

            if($product)
            {
                $item = new Cart();
                if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    return response()->json(['status'=>$product->name."Already added to cart"]);
                }
                else
                {
                    $item->product_id = $product_id;
                    $item->user_id= Auth::id();
                    $item->product_qty = $product_qty;

                    $item->save();
                    return response()->json(['status'=> $product->name."Added to cart"]);
                
                }
            }
        }
        else
        {
            return response()->json(['status' => "Login to Continue"]);
        }
    }

    public function viewCart()
    {
        $items = Cart::where('user_id',Auth::id())->get();
        return view('frontend.viewCart',compact('items'));
    }

    public function deleteitem(Request $request)
    {   
        if(Auth::check())
        {
            $prod_id = $request->input('prod_id');
            if(Cart::where('product_id',$prod_id)->where('user_id',Auth::id())->exists())
            {
                $cartItem = Cart::where('product_id',$prod_id)->where('user_id',Auth::id())->first();
                $cartItem->delete();

                return response()->json(['status' => "Product Deleted Successfully"]);
            }
        }
        else{
            return response()->json(['status'=>"Login to Continue"]);
        }
    }

    public function updateProduct(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $prod_qty = $request->input('prod_qty');

        if(Auth::check())
        {
            if(Cart::where('product_id',$prod_id)->where('user_id',Auth::id())->exists())
            {
                $cart = Cart::where('product_id',$prod_id)->where('user_id',Auth::id())->first();
                $cart->product_qty = $prod_qty;

                $cart->update();
                return response()->json(['status'=>"Product Quantity Updated"]);
            }
        }
    }

}
