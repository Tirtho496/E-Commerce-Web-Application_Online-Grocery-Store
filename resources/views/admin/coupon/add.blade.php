@extends('layouts.admin')

@section('content')

<div class="card">
    <div class ="card-header">
        <h4>Add Coupon</h4>
    </div>
    <div class="card-body">
        <form action="{{url('insert-coupon')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class = "row">
                
                <div class ="col-md-6">
                    <label for="">Code</label>
                    <input type="text" class= "form-control" name="code">
                    <label for="">Type</label>
                    <input type="checkbox" name="type">
                </div>
                <div class = "col-md-6">
                    <label for="">Points</label>
                    <input type="text" class= "form-control" name="points">
                </div>
                <div class ="col-md-6">
                    <label for="">Value</label>
                    <input type="text" class= "form-control" name="value">
                </div>

                <div class ="col-md-6">
                    <label for="">Percentage</label>
                    <input type="text" class= "form-control" name="percent_off">
                </div>
                
                <div class="col-md-12">
                    <button type="submit" class = "btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection