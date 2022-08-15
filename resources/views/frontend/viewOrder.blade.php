@include('layouts.include.frontendnavbar')
@include('layouts.include.links')


@section('title')
Checkout
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h5 class="mb-0">Checkout</h5>
        </div>
    </div>
    <div class="container">
        <form action="{{url('place-order')}}" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Shipping Details</h6>
                            <hr>
                            <div class="row order-details">
                                <div class="col-md-6 ">
                                    <label for="firstName">First Name</label>
                                    <div class="border">{{$order->fname}}</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName">Last Name</label>
                                    <div class="border">{{$order->lname}}</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Phone Number</label>
                                    <div class="border">{{$order->phone}}</div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="">Email</label>
                                    <div class="border">{{$order->email}}</div>
                                </div>
                                @php $address = $order->address.','.$order->city.','.$order->district.','.$order->division @endphp
                                <div class="col-md-12">
                                    <label for="">Address</label>
                                    <div class="border">{{$address}}</div>
                                </div>
                                

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order Details</h6>
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price per piece</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($orderItems as $item)
                                    <tr>
                                        <td>{{$item->products->name}}</td>
                                        <td>{{$item->qty}}</td>
                                        <td>{{$item->products->price}}</td>
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                                
                            </table>  
                            
                            
                        </div>
                        <div class="card-footer">
                            <h6>Total Price: BDT {{$order->total_price}}
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
@endsection

@yield('scripts')