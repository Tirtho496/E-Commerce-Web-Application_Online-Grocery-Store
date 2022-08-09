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
                            <h6>Customer Details</h6>
                            <hr>
                            <div class="row checkout">
                                <div class="col-md-6">
                                    <label for="firstName">First Name</label>
                                    <input type="text" name="fname" class="form-control" placeholder="Enter First Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" name="lname" class="form-control" placeholder="Enter Last Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number">
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="">Email</label>
                                    <input type="text" name= "email" class="form-control" placeholder="Enter Email Address">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Enter Address">
                                </div>
                                <div class="col-md-6">
                                    <label for="">City</label>
                                    <input type="text" name="city" class="form-control" placeholder="Enter City">
                                </div>
                                <div class="col-md-6">
                                    <label for="">District</label>
                                    <input type="text" name="district" class="form-control" placeholder="Enter District">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Division</label>
                                    <input type="text" name = "division" class="form-control" placeholder="Enter Division">
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
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($newcartItems as $item)
                                    @php
                                        $total += $item->products->price*$item->product_qty;
                                    @endphp
                                    <tr>
                                        <td>{{$item->products->name}}</td>
                                        <td>{{$item->product_qty}}</td>
                                        <td>{{$item->products->price}}</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>  
                            <h6>Total Price: {{$total}} </h6>
                            @if($item->user->coupon->type == 0)
                                <h6>Discount: - {{$item->user->coupon->value}} </h6>
                                <h6>Grand Total: {{floor($total- ($item->user->coupon->value))}} </h6>
                            @else
                                <h6>Discount: {{$item->user->coupon->percent_off}} % </h6>
                                <h6>Grand Total: BDT {{floor($total- ($item->user->coupon->percent_off*$total/100))}} </h6>
                            @endif
                            <h6>Added Points: {{floor($total/1000)*100}} </h6>
                            <hr>
                            <button type="submit" class="btn btn-success">Place Order</button>
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
    <script>
@endsection

@yield('scripts')