<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){

        $wish = Wishlist::where('user_id',Auth::id())->get();
        return view('frontend.wishlist',compact('wish'));
    }


    public function add(Request $request)
    {
        if(Auth::check())
        {
            $prod_id = $request->input('product_id');
            $prod_qty=$request->input('product_qty');
            if(Product::find($prod_id))
            {
                $wish = new Wishlist();

                $wish->product_id = $prod_id;
                $wish->user_id = Auth::id();
                $wish->product_qty = $prod_qty;

                $wish->save();

                return response()->json(['status'=>"Product added to wishlist"]);
            }
            else
            {
                return response()->json(['status'=>"Product does not exist"]);
            }
        }
        else
        {
            return response()->json(['status' => "Login to Continue"]);
        }
    }

    public function deleteitem(Request $request)
    {   
        if(Auth::check())
        {
            $prod_id = $request->input('prod_id');
            if(Wishlist::where('product_id',$prod_id)->where('user_id',Auth::id())->exists())
            {
                $wishItem = Wishlist::where('product_id',$prod_id)->where('user_id',Auth::id())->first();
                $wishItem->delete();

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
            if(Wishlist::where('product_id',$prod_id)->where('user_id',Auth::id())->exists())
            {
                $cart = Wishlist::where('product_id',$prod_id)->where('user_id',Auth::id())->first();
                $cart->product_qty = $prod_qty;

                $cart->update();
                return response()->json(['status'=>"Product Quantity Updated"]);
            }
        }
    }

}

