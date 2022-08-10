@extends('layouts.include.links')

<body>
    <div class="d-flex" id = "wrapper" style="padding:5px;">
        @include('layouts.include.frontsidebar')
        <div id="page-content-wrapper">
            @include('layouts.include.frontendnavbar')
            <div class="content">
                 @yield('content')
            
            </div>
        </div>
    
    </div>

    
    <script src="{{asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    
    @if(session('status'))
        <script>
            swal("{{session('status')}}")
        </script>
    @endif
    @yield('scripts')

    


</body>

