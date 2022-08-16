<div class="border-end bg-dark" id="sidebar-wrapper">
  <div class="sidebar-heading bg-dark"><a style="text-decoration: none;" href="{{ url('/') }}"><img class="slider-logo" src="{{asset('images/cart.png')}}"><h4>FRIENDS GROCERY<h4></a></div>
  <div class="list-group list-group-flush bg-dark">
      @foreach($category as $item)
        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="{{url('category/'.$item->slug)}}">{{$item->name}}</a>   
      @endforeach
  </div>
</div>