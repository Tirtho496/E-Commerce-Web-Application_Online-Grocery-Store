@include('layouts.include.links')

@section('content')
  
<div class="container" style="color:black; font-weight: bold; margin-top:2%">
  
    <div class="row justify-content-center">
        <div class="col-md-6 ">
            <div class="card bg-warning">
                <div class="card-body" >
                    <h4 class="panel-title display-td" >Payment Details</h4>   
                    <hr>      
                    <form 
                                role="form" 
                                action="{{url('place-order')}}" 
                                method="POST" 
                                id = "#form1"
                                >
                                {{csrf_field()}}       
                    <div class="row justify-content-center">
                        <div class='col-md-8' style="margin-top:2%;">
                            <label class='control-label'>Name on Card</label> <input
                            class='form-control' size='4' type='text'>
                        </div>
  
                        <div class='col-md-8' style="margin-top:2%;">
                            <label class='control-label'>Card Number</label> <input
                                autocomplete='off' class='form-control card-number' size='20'
                                type='text'>
                        </div>

                        <div class="w-100"></div>
                        
                        <div class='col-md-4' style="margin-top:2%;">
                            <label class='control-label'>CVC</label> <input autocomplete='off'
                                class='form-control card-cvc' placeholder='' size='4'
                                type='text'>
                        </div>
                        <div class='col-md-4' style="margin-top:2%;">
                            <label class='control-label'>Expiry</label> <input
                                class='form-control card-expiry-month' placeholder='MM/YYYY' size='5'
                                type='text'>
                        </div>
                        
                        <div class="col-md-8" style="margin-top:2%;">
                            <button class="btn btn-info" type="submit">Pay Now ($100)</button>
                        </div>
                        </form>
                    </div>
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

    <script src="{{ asset('frontend/js/bootstrapValidator.js') }}"></script>
    <script>

    $(document).ready(function() {
            $('#form1').bootstrapValidator({
            fields: { 
            name: {
            verbose: false,
                validators: {notEmpty: {
                        message: 'The Name is required and can\'t be empty'
                    },regexp: {
                        regexp: /^[a-zA-Z ]+$/,
                        message: 'The Name can only consist of alphabets'
                    } } },
            number: {
            verbose: false,
                validators: {notEmpty: {
                        message: 'The Card Number is required and can\'t be empty'
                    },stringLength: {
                    min: 16,
                    max: 16,
                    message: 'The Card Number must 16 characters long'
                },regexp: {
                        regexp: /^[0-9 ]+$/,
                        message: 'Enter a valid Card Number'
                    } } },
            date: {
            verbose: false,
                validators: {notEmpty: {
                        message: 'The Expire Date is required and can\'t be empty'
                    } } },
            cvv: {
            verbose: false,
                validators: {notEmpty: {
                        message: 'The cvv is required and can\'t be empty'
                    },stringLength: {
                    min: 3,
                    max: 3,
                    message: 'The cvv must 3 characters long'
                },regexp: {
                        regexp: /^[0-9 ]+$/,
                        message: 'Enter a valid cvv'
                    } } }}
            });
            });
    </script>

@endsection

@yield('scripts') 