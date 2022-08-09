

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <div class ="row">
            <div class="col-md-10"><input class="form-control" id="search_product" type="search" placeholder="Search"></div>
            <div class="col-md-2"><button class="input-group-text"><i class="fa fa-search" style="padding:3px; margin-top:2px;"></i></button></div>

        
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item active"><a class= "nav-link" href="{{ url('/') }}">Home</a></li>
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item active"><a class = "nav-link" href="{{ url('/home') }}">Profile</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('cart')}}"><i class="fa fa-shopping-cart"></i></a>
                            {{-- <span class ="badge badge-pill c_count style=" color="crimson;">0</span></a> --}}

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('wishlist')}}"><i class="fa fa-heart"></i></a>
                            {{-- <span class ="badge badge-pill w_count" style="color:crimson;">0</span></a> --}}
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                            </a>
                  
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                          </li>
                    @else
                        <li class="nav-item"><a class= "nav-link" href="{{ route('login') }}">Log in</a></li>
                        @if (Route::has('register'))
                            <li class="nav-item"><a class= "nav-link" href="{{ route('register') }}">Register</a></a></li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>



{{-- <form onsubmit="event.preventDefault()" class="form-inline my-2 my-lg-0"> <input class="form-control mr-sm-2" type="text" placeholder="Search"> <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button> </form> --}}