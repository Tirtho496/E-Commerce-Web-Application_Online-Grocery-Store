@extends('layouts.frontend')
@extends('layouts.include.links')

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h5 class="mb-0">Trending Products</h5>
    </div>
</div>
    <div class="py-5">
        <div class ="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class = "row">
                        @foreach ($trending_prod as $trending)
                            <div class = "col-md-3 mb-3">
                                <div class="card">
                                    <a href ="{{url('product/'.$trending->slug)}}" style="text-decoration: none; color:black;">
                                    <img style ="width:100px; height:100px; object-fit:contain; " src="{{asset('assets/uploads/product/'.$trending->image)}}" alt="Trending Product">
                                    <div class ="card-body">
                                        <h6>{{$trending->name}}</h6>
                                        <p>{{$trending->short_description}}</p>
                                        <p>BDT {{$trending->price}}</p>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection