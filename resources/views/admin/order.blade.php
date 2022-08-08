@extends('layouts.admin')

@section('content')

<div class="card">
    <div class ="card-body">
        <h2>Current Orders</h2>
    </div>
    <div class ="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Fname</th>
                    <th>Lname</th>
                    <th>Address</th>
                    <th>Order Date</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $item)
                <tr>
                    <td>{{$item->tracking_no}}</td>
                    <td>{{$item->fname}}</td>
                    <td>{{$item->lname}}</td>
                    @php $address = $item->address.','.$item->city.','.$item->district.','.$item->division @endphp
                    <td><p>{{$address}}</p></td>
                    <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
                    <td>{{$item->total_price}}</td>
                    <td>{{$item->status == '0'?'Pending': 'Shipped'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection