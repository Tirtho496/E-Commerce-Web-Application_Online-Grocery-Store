@extends('layouts.app')

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h5 class="mb-0">Welcome To Your Dashboard</h5>
        </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h6>Current Orders</h6>
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Order Date</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $item)
                                    <tr>
                                        
                                        @if ($item->status == '0' || $item->status == '1')
                                            <td>{{$item->tracking_no}}</td>
                                            <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
                                            <td>{{$item->total_price}}</td>
                                            <td>{{$item->status == '0'?'Pending': 'Shipped'}}</td>
                                            <td><a href="{{url('view-this-order/'.$item->id)}}" class="btn btn-primary">View</a></td>
                                        @endif
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                                
                            </table>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
