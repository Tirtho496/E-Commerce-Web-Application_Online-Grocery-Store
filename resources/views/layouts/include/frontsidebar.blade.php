<div class="border-end bg-white" id="sidebar-wrapper">
  <div class="sidebar-heading border-bottom bg-light">Start Bootstrap</div>
  <div class="list-group list-group-flush">
      @foreach($category as $item)
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{url('category/'.$item->slug)}}">{{$item->name}}</a>   
      @endforeach
  </div>
</div>