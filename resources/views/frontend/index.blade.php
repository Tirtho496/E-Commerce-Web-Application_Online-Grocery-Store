@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h5 class="mb-0">Trending Category</h5>
        </div>
    </div>

    <div class="py-5">
        <div class ="container">
            
            <div class="row">
                <div class="owl-carousel owl-theme">
                    @foreach ($feat_cat as $item)
                        <div class = "item">
                            <div class="card ">
                                
                                <a href ="{{url('category/'.$item->slug)}}" style="text-decoration: none; color:black;">
                                <img style ="width:100%;height:150px; object-fit:cover; " src="{{asset('assets/uploads/category/'.$item->image)}}" alt="Trending Categories"></a>
                                
                                
                                <div class ="card-body" style="background-color:rgba(22,28,45); color:antiquewhite">
                                    <h6>{{$item->name}}</h6>
                                </div>
                                
                            </div>
                        </div>
                    @endforeach
                    
                </div>
                        
            </div>
        </div>
    </div>

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
                                    <div class="card-body">
                                        <a href ="{{url('product/'.$trending->slug)}}" style="text-decoration: none; color:black;">
                                        <img style ="height:100px;object-fit:cover; " src="{{asset('assets/uploads/product/'.$trending->image)}}" alt="Trending Product"></a>
                                    </div>
                                    
                                    <div class ="card-body" style="background-color:rgba(22,28,45); color:antiquewhite">
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

    <div class="contact">
       <h3>Contact Us</h3>
      <form action="{{url('place-comment')}}" method="POST">      
        {{csrf_field()}}
        <input name="name" type="text" class="feedback-input" placeholder="Name" />   
        <input name="email" type="text" class="feedback-input" placeholder="Email" />
        <textarea name="text" class="feedback-input" placeholder="Comment"></textarea>
        <input type="submit" value="SUBMIT"/>
      </form>
    </div>

</div>
@endsection

@section('scripts')
<script>
    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
</script>
@endsection