@include('layouts.include.frontendnavbar')
@include('layouts.include.links')


@section('title')
Checkout
@endsection

@section('content')
    @if (Session::has('msg'))
    <div class="alert alert-danger">
        <h4>{{Session::get("msg")}}</h4>
    </div>
    @endif
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
                            @if($item->user->coupon_id)
                                <h6>Total Price: {{$total}} </h6>
                                @if($item->user->coupon->type == 0)
                                    <h6>Discount: - {{$item->user->coupon->value}} </h6>
                                    <h6>Grand Total: {{floor($total- ($item->user->coupon->value))}} </h6>
                                @else
                                    <h6>Discount: {{$item->user->coupon->percent_off}} % </h6>
                                    <h6>Grand Total: BDT {{floor($total- ($item->user->coupon->percent_off*$total/100))}} </h6>
                                @endif
                            @else
                                <h6>Total Price: {{$total}} </h6>
                            @endif
                            <h6>Added Points: {{floor($total/1000)*100}} </h6>
                            <hr>
                            <button type="submit" class="btn btn-info">Place order with cash on delivery</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:2%;">
                <div class="col-md-7">
                    <div class="creditCardForm">
                        <div class="heading">
                            <h4>Pay now for a cashless delivery</h4>
                        </div>
                        <div class="payment">
                            <form>
                                <div class="form-group owner">
                                    <label for="owner">Name on Card</label>
                                    <input type="text" class="form-control" id="owner">
                                </div>
                                <div class="form-group CVV">
                                    <label for="cvv">CVV</label>
                                    <input type="text" class="form-control" id="cvv">
                                </div>
                                <div class="form-group" id="card-number-field">
                                    <label for="cardNumber">Card Number</label>
                                    <input type="text" class="form-control" id="cardNumber">
                                </div>
                                <div class="form-group" id="expiration-date">
                                    <label>Expiration Date</label>
                                    <select>
                                        <option value="01">January</option>
                                        <option value="02">February </option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <select>
                                        <option value="16"> 2022</option>
                                        <option value="17"> 2023</option>
                                        <option value="18"> 2024</option>
                                        <option value="19"> 2025</option>
                                        <option value="20"> 2026</option>
                                        <option value="21"> 2027</option>
                                    </select>
                                </div>
                                <div class="form-group" id="credit_cards">
                                    <img src="{{asset('images/visa.jpg')}}" id="visa">
                                    <img src="{{asset('images/mastercard.jpg')}}" id="mastercard">
                                    <img src="{{asset('images/amex.jpg')}}" id="amex">
                                </div>
                                <div class="form-group" id="pay-now">
                                    @php
                                        if($item->user->coupon_id)
                                        {
                                            if($item->user->coupon->type == 0)
                                            {
                                                $total = floor($total- ($item->user->coupon->value));
                                            }
                                            else
                                            {
                                                $total =  floor($total- ($item->user->coupon->percent_off*$total/100));
                                            }
                                        }
                                    @endphp
                                    <button type="submit" class="btn btn-info" id="confirm-purchase">Pay BDT {{$total}}</button>
                                </div>
                            </form>
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
        <script src="{{ asset('frontend/js/jquery.payform.min.js') }}"></script>
        <script src="{{ asset('frontend/js/script.js') }}"></script>
@endsection

@yield('scripts')