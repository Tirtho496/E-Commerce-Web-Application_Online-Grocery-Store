@extends('layouts.frontend')

@section('title',$product->name)

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h5 class="mb-0">{{$product->name}}</h5>
    </div>
</div>

<div class="container">
    <div class="card shadow product_data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 border-right">
                    <img src="{{asset('assets/uploads/product/'.$product->image)}}" class="w-100" alt="">
                </div>
                <div class="col-md-8">
                    <label class="me-3">Price: BDT {{$product->price}}</label>
                    @if($product->qty>0)
                        <label class="badge bg-success">In Stock</label>
                    @else
                        <label class="badge bg-danger">Out of Stock</label>
                    @endif
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <input type="hidden" value="{{$product->id}}" class="prod_id">
                            <input type="hidden" value="{{$product->qty}}" class="available">
                            <label for="quantity">Quantity</label>
                            <div class="input-group text-center mb-3">
                                <button class ="input-group-text decrement-btn">-</button>
                                <input type="text" name="quantity" value="0" class="form-control text-center qty-input"/>
                                <button class="input-group-text increment-btn">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <br/>
                        @if($product->qty>0)
                            <button type="button" class="btn btn-success me-3 float-start add-to-cart">Add to Cart <i class="fa fa-shopping-cart"></i> </button>
                        @endif
                        <button type="button" class="btn btn-success me-3 float-start add-to-wishlist">Add to Wishlist <i class="fa fa-heart"></i></button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>

    $(document).ready(function (){
        $('.add-to-cart').click(function(e){
            e.preventDefault();

            var product_id = $(this).closest('.product_data').find('.prod_id').val();
            var product_qty = $(this).closest('.product_data').find('.qty-input').val();


            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                method: "POST",
                url: "/add-to-cart",
                data: {
                    'product_id': product_id,
                    'product_qty': product_qty,
                },
                success: function(response){
                    alert(response.status);
                }
            });

        });
    });

    $(document).ready(function (){
        $('.add-to-wishlist').click(function(e){
            e.preventDefault();

            var product_id = $(this).closest('.product_data').find('.prod_id').val();


            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                method: "POST",
                url: "/add-to-wishlist",
                data: {
                    'product_id': product_id,
                },
                success: function(response){
                    alert(response.status);
                }
            });

        });
    });

    $(document).ready(function(){
        $('.increment-btn').click(function (e){
            e.preventDefault();
            var inc_val= $(this).closest('.product_data').find('.qty-input').val()
            var permit= $(this).closest('.product_data').find('.available').val()
            var value = parseInt(inc_val,10);
            value = isNaN(value)? 0 : value;
            if(value<permit && value<10)
            {
                value++;
                $(this).closest('.product_data').find('.qty-input').val(value);
            }
        });
    });

    $(document).ready(function(){
        $('.decrement-btn').click(function (e){
            e.preventDefault();
            var dec_val= $(this).closest('.product_data').find('.qty-input').val()
            var value = parseInt(dec_val,10);
            value = isNaN(value)? 0 : value;
            if(value>1)
            {
                value--;
                $(this).closest('.product_data').find('.qty-input').val(value);
            }
        });
    });
</script>


@endsection