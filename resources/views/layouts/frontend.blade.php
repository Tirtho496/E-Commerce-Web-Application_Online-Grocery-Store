@extends('layouts.include.links')
<body>
    <div class="d-flex" id = "wrapper">
        @include('layouts.include.frontsidebar')
        <div id="page-content-wrapper">
            @include('layouts.include.frontendnavbar')

            <div class="content">
                 @yield('content')
            
            </div>
        </div>
    
    </div>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    
    @if(session('status'))
        <script>
            swal("{{session('status')}}")
        </script>
    @endif


    @yield('scripts')

    


</body>
</html>
