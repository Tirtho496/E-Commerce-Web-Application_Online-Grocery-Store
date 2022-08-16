@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class ="card-body">
            <h1>Admin Panel</h1>
            @php
                $total = 0;
                $total_d = 0;
                foreach($orders as $item)
                {
                    $total = $total + $item->total_price;
                    $total_d++;
                }

                $total_p = 0;
                foreach($orders as $item)
                {
                    $total_p++;
                }

            @endphp
            <h3>Total Sales: BDT {{$total}}</h3>
            <h3>Successful Deliveries: {{$total_d}}</h3>
            <h3>Pending Deliveries: {{$total_p}}</h3>
        </div>
    </div>
@endsection
