@include('layouts.include.frontendnavbar')
@include('layouts.include.links')

@section('title')
Wishlist
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h5 class="mb-0">My Wishlist</h5>
        </div>
    </div>
    <div class="container">
        <div class="card shadow product_data">
            <div class="card-body">
                @if($wish->count()>0)
                @foreach($wish as $item)
                <div class="row ">
                    <div class="col-md-2">
                        <img src="{{asset('assets/uploads/product/'.$item->products->image)}}" height="70px" width="70px" alt="Product Image">
                    </div>
                    <div class="col-md-2" style="padding-top:25px;font-size:70%;">
                        <h6>{{$item->products->name}}</h6>
                    </div>

                    <div class="col-md-2" style="padding-top:25px;font-size:70%;">
                        <h6>{{$item->products->price}}</h6>
                    </div>

                    <div class="col-md-2" style="padding-top:5px;font-size:70%;">
                        <input type="hidden" value="{{$item->product_id}}" class="prod_id">
                            <input type="hidden" value="{{$item->products->qty}}" class="available">
                            @if($item->products->qty >= $item->product_qty)
                                <label for="quantity">Quantity</label>
                                
                                <div class="input-group text-center mb-3" >
                                    <button class ="input-group-text decrement-btn storeQty">-</button>
                                    <input type="text" name="quantity" value="{{$item->product_qty}}" class="form-control text-center qty-input"/>
                                    <button class="input-group-text increment-btn storeQty">+</button>
                                </div>
                            @else 
                                <h6 style="padding-top:23px;">Out of Stock</h6>
                            @endif
                    </div>

                    <div class="col-md-2" style="padding-top:23px;">
                        <button type="button" class="btn btn-success me-3 float-start add-to-cart"><i class="fa fa-shopping-cart" ></i>Add to Cart</button>
                    </div>
                    
                    <div class="col-md-2" style="padding-top:23px;">
                        <button type="button" class="btn btn-danger me-3 float-start delete-item"><i class="fa fa-trash" ></i>Remove</button>
                    </div>
                </div>
                    
                @endforeach
                @else
                    <h4>Wishlist is empty</h4>
                @endif
            </div>
           
        </div>
    </div>
@endsection

@yield('content')

@section('scripts')

        <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>

            <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

            <script>
                  var availableTags = [];
                  $.ajax({
                    method: "GET",
                    url: "/product_list",
                    success: function(response){
                        startAutoComplete(response);
                    }
                  });
                  function startAutoComplete(availableTags)
                  {
                    $( "#search_product" ).autocomplete({
                    source: availableTags
                  });
                  }
                  
                </script>

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
        
        $('.delete-item').click(function(e){
            e.preventDefault();

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var prod_id = $(this).closest('.product_data').find('.prod_id').val();

            $.ajax({
                method:"POST",
                url: "delete-wishlist-item",
                data: {
                    'prod_id':prod_id,
                },
                success: function(response)
                {
                    window.location.reload();
                    swal("",response.status, "success");
                }
            });
        });

        $(document).ready(function(){
            $('.increment-btn').click(function (e){
                e.preventDefault();
                var inc_val= $(this).closest('.product_data').find('.qty-input').val()
                var permit= $(this).closest('.product_data').find('.available').val()
                var value = parseInt(inc_val,10);
                value = isNaN(value)? 0 : value;
                if(value<=permit && value<10)
                {
                    value++;
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }

                $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var prod_id = $(this).closest('.product_data').find('.prod_id').val();
            var qty = $(this).closest('.product_data').find('.qty-input').val();

            
            $.ajax({
                type: "POST",
                url: "update-wish",
                data: {
                    'prod_id':prod_id,
                    'prod_qty': qty,
                },
                success: function (response) {
                    window.location.reload();
                    swal("",response.status, "success");
                }
            });
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
                $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var prod_id = $(this).closest('.product_data').find('.prod_id').val();
            var qty = $(this).closest('.product_data').find('.qty-input').val();

            
            $.ajax({
                type: "POST",
                url: "update-wish",
                data: {
                    'prod_id':prod_id,
                    'prod_qty': qty,
                },
                success: function (response) {
                    window.location.reload();
                    swal("",response.status, "success");
                }
            })
            });
        });
        </script>

@endsection

@yield('scripts')
    
