@include('layouts.include.frontendnavbar')
@include('layouts.include.links')

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h5 class="mb-0">Welcome To Your Dashboard</h5>
        </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h6>Current Orders</h6>
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Order Date</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $item)
                                    <tr class="order_data">
                                        
                                        @if ($item->status == '0' || $item->status == '1')
                                            <td>{{$item->tracking_no}}</td>
                                            <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
                                            <td>{{$item->total_price}}</td>
                                            <td>{{$item->status == '0'?'Pending': 'Shipped'}}</td>
                                            <td><a href="{{url('view-this-order/'.$item->id)}}" class="btn btn-primary">View</a></td>
                                            <input type="hidden" value="{{$item->id}}" class="order_id">
                                            <td><a href="{{url('delete-order/'.$item->id)}}" class="btn btn-danger">Cancel Order</a></td>
                                        @endif
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                                
                            </table>  
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6>Available Coupons</h6>
                    <div class="row">
                    @foreach($coupon as $item)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header"><h6>{{$item->code}}</h6></div>
                            <div class="card-body"><a class="btn btn-primary" href="{{url('redeem/'.$item->id)}}/">Redeem</a></div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
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
        

@endsection

@yield('scripts')
