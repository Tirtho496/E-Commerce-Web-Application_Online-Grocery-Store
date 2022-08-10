@include('layouts.include.links')

@section('content')
  
<div class="container" style="color:black; font-weight: bold; margin-top:2%">
  
    <div class="row justify-content-center">
        <div class="col-md-6 ">
            <div class="card bg-warning">
                <div class="card-body" >
                    <h4 class="panel-title display-td" >Payment Details</h4>   
                    <hr>              
                    <div class="row justify-content-center">
  
  
                        {{-- <form 
                                role="form" 
                                action="{{ route('stripe.post') }}" 
                                method="post" 
                                class="require-validation"
                                data-cc-on-file="false"
                                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                id="payment-form">
                            @csrf --}}
  
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
                        
                    </div>
                          
                    {{-- </form> --}}
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
    <script>

    <script type="text/javascript">
    $(function() {
    
        var $form = $(".require-validation");
    
        $('form.require-validation').bind('submit', function(e) {
            var $form         = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                            'input[type=text]', 'input[type=file]',
                            'textarea'].join(', '),
            $inputs       = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid         = true;
            $errorMessage.addClass('hide');
    
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }
            });
    
            if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
            }
    
    });
    
    function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];
                
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    
    });
    </script>

@endsection

@yield('scripts') 