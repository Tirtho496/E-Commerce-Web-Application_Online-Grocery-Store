<nav class="navbar navbar-expand-lg bg-dark navbar-absolute">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      
      <a class="navbar-brand" href="{{url('/dashboard')}}"><img src="{{asset('images/admin.png')}}" style="width:40px; height:auto; float:left; margin-right: 4%;"><h5>Admin Panel<h5></a>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="dropdown-item" style="color:aliceblue" href="{{ route('logout') }}"
            onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>