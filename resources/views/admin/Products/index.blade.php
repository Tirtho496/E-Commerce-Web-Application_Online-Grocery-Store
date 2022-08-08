@extends('layouts.admin')

@section('content')

<div class="card">
    <div class ="card-body">
        <h2>Products Panel</h2>
    </div>
    <div class ="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->main_description}}</td>
                    <td>
                        <img src ="{{asset('assets/uploads/product/'.$item->image)}}" class = "w-25" alt="Image Here">
                    </td>
                    <td>
                        <a href = "{{url('edit-e-prod/'.$item->id)}}" class = "btn btn-success" style="padding-left:29px;padding-right:29px">Edit</a>
                        <a href ="{{url('delete-product/'.$item->id)}}" class ="btn btn-danger">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection