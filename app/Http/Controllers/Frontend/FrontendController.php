<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index(){

        $category = Category::all();
        $trending_prod = Product::where('trending','1')->get();
        return view('frontend.index',compact('category','trending_prod'));
    }

    public function viewProduct($slug)
    {
        if(Product::where('slug',$slug)->exists())
        {
            $category = Category::all();
            $product = Product::where('slug',$slug)->first();
            return view('frontend.view',compact('category','product'));
        }
        else{
            return redirect('/')->with('status','No such product found');
        }
    }

    public function viewCategory($slug)
    {
        if(Category::where('slug',$slug)->exists())
        {
            $category = Category::all();
            $cat = $category->where('slug',$slug)->first();
            $product = Product::where('category_id',$cat->id)->get();
            return view('frontend.viewCat',compact('product','category','cat'));
        }
        else{
            return redirect('/')->with('status','No such product found');
        }
    }
}
