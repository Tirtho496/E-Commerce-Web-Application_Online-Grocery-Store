<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index',compact('products'));

    }

    public function add()
    {
        $category = Category::all();
        return view('admin.products.add',compact('category'));
    }

    public function insert(Request $request)
    {
        $product= new Product();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('assets/uploads/product',$filename);
            $product->image = $filename;
        }

        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->short_description = $request->input('short-description');
        $product->main_description = $request->input('main-description');
        $product->price = $request->input('price');
        $product->qty = $request->input('qty');
        $product->status = $request->input('status') == TRUE?'1':'0';
        $product->trending = $request->input('trending')  == TRUE?'1':'0';
        $product->save();
        return redirect('products')->with('status','Product Added Successfully');


    }

    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.Products.edit',compact('product','category'));
    }

    public function update(Request $request,$id)
    {
        $product= Product::find($id);

        $im_path = 'assets/uploads/product/'.$product->image;
        if(File::exists($im_path))
        {
            File::delete($im_path);
        }
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('assets/uploads/product',$filename);
            $product->image = $filename;
        }

        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->short_description = $request->input('short-description');
        $product->main_description = $request->input('main-description');
        $product->price = $request->input('price');
        $product->qty = $request->input('qty');
        $product->status = $request->input('status') == TRUE?'1':'0';
        $product->trending = $request->input('trending')  == TRUE?'1':'0';
        $product->update();
        return redirect('/dashboard')->with('status','Product Updated Successfully');


    }

    public function delete($id)
    {
        $product = Product::find($id);
        if($product->image)
        {
            $path = 'assets/uploads/product/'.$product->image;
            if(File::exists($path)){
                File::delete($path);
            }
            
        }
        $product->delete();
        return redirect('products')->with('status','Product Deleted Successfully');
    }
}
