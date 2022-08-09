@extends('layouts.admin')

@section('content')

<div class="card">
    <div class ="card-body">
        <h2>Coupons</h2>
    </div>
    <div class ="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Percentage</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupon as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->code}}</td>
                    @if($item->type == 0)
                        <td>Value Coupon</td>
                    @else
                        <td>Percentage Coupon</td>
                    @endif

                    <td>{{$item->value}}</td>
                    <td>{{$item->percent_off}}</td>
                    <td>{{$item->points}}</td>
                    <td>
                        <a href ="{{url('delete-coupon/'.$item->id)}}" class ="btn btn-danger">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection