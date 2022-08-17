@extends('layouts.admin')

@section('content')

<div class="card">
    <div class ="card-body">
        <h2>Registerd Users</h2>
    </div>
    <div class ="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->points}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection