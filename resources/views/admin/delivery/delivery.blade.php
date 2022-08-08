@extends('layouts.admin')

@section('content')

<div class="card">
    <div class ="card-body">
        <h2>Delivery Panel</h2>
    </div>
    
        <div class ="card-body">
            <form action="{{url('update-delivery')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
            <input type="text" class= "form-control" name="tracking" placeholder="Enter Tracking Number">
        
            <div class="row">
                <div class = "col-md-6 mb-3">
                    <label for="">Shipped</label>
                    <input type="checkbox" name="shipped">
                </div>
                <div class = "col-md-6 mb-3">
                    <label for="">Delivered</label>
                    <input type="checkbox" name="delivered">
                </div>
            </div>
        
        <div class="col-md-12">
            <button type="submit" class = "btn btn-primary">Submit</button>
        </div>
        </form>
        </div>
</div>

@endsection