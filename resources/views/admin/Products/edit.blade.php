@extends('layouts.admin')

@section('content')

<div class="card">
    <div class ="card-header">
        <h4>Edit Product</h4>
    </div>
    <div class="card-body">
        <form action="{{url('update-product/'.$product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class = "row">
                <div class = "col-md-12 mb-3">
                    <select class="form-select" name="category_id" aria-label="Default select example">
                        <option value="">Select Category</option>
                        @foreach($category as $item)
                            <option value = "{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class ="col-md-6">
                    <label for="">Name</label>
                    <input type="text" value="{{$product->name}}" class= "form-control" name="name">
                </div>
                <div class ="col-md-6">
                    <label for="">Slug</label>
                    <input type="text" value="{{$product->slug}}" class= "form-control" name="slug">
                </div>
                <div class = "col-md-12">
                    <label for="">Short Description</label>
                    <textarea name="short-description" value = "{{$product->short_description}}" cols="30" rows="5" class="form-control"></textarea>
                </div>

                <div class = "col-md-12">
                    <label for="">Description</label>
                    <textarea name="main-description" value = "{{$product->main_description}}" cols="30" rows="5" class="form-control"></textarea>
                </div>

                <div class ="col-md-6">
                    <label for="">Price</label>
                    <input type="number" value = "{{$product->price}}" class= "form-control" name="price">
                </div>

                <div class ="col-md-6">
                    <label for="">Quantity</label>
                    <input type="number" value = "{{$product->qty}}" class= "form-control" name="qty">
                </div>

                <div class = "col-md-6 mb-3">
                    <label for="">Status</label>
                    <input type="checkbox" {{$product->status == "1"?'checked':''}} name="status">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Trending</label>
                    <input type="checkbox" {{$product->trending == "1"?'checked':''}}  name="trending">
                </div>
                <div class ="col-md-12">
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="col-md-12">
                    <button type="submit" class = "btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection