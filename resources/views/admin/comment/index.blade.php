@extends('layouts.admin')

@section('content')

<div class="card">
    <div class ="card-body">
        <h2>User Comments</h2>
    </div>
    <div class ="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comment as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->comment}}</td>
                    <td>
                        <a href ="{{url('delete-comment/'.$item->id)}}" class ="btn btn-danger">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection