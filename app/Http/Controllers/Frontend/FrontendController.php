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
        $feat_cat = Category::where('Popular','1')->get();
        $trending_prod = Product::where('trending','1')->inRandomOrder()->limit(8)->get();
        return view('frontend.index',compact('category','trending_prod','feat_cat'));
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

    public function productList()
    {
        $products = Product::select('name')->where('status','0')->get();
        $data = [];

        foreach($products as $item){
            $data[] = $item['name'];
        }

        return $data;
    }

    public function searchProduct(Request $request)
    {
        $product = $request->search;

        if($product != "")
        {
            $item = Product::where("name","LIKE","%$product%")->first();
            if($item){
                return redirect('product/'.$item->slug);
            }
            else{
                return redirect()->back()->with("status","No products matched with search");
            }
        }
        else{
            return redirect()->back();
        }
        
    }
}
