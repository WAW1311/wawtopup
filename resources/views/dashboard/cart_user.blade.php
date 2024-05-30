@extends('dashboard.app')
@section('content')
<div class="Container">
<div class="table-responsive p-3 rounded">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Order_id</th>
                <th scope="col">Product_id</th>
                <th scope="col">Category</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">User_id</th>
                <th scope="col">Server_id</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            @foreach ($cart as $carts)
                <tbody>
                    <tr>
                        <td>{{$carts->order_id}}</td>
                        <td>{{$carts->product_id}}</td>
                        <td>{{$carts->category}}</td>
                        <td>{{$carts->name}}</td>
                        <td>{{$carts->price}}</td>
                        <td>{{$carts->quantity}}</td>
                        <td>{{$carts->user_id}}</td>
                        <td>{{$carts->server_id}}</td>
                        @if ($carts->status == 'pending')
                            <td><button type="button" class="btn btn-primary" style="cursor: none;">{{$carts->status}}</button></td>
                        @elseif ($carts->status == 'success')
                            <td><button type="button" class="btn btn-success" style="cursor: none;">{{$carts->status}}</button></td>
                        @else
                            <td><button type="button" class="btn btn-danger" style="cursor: none;">{{$carts->status}}</button></td>
                        @endif
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection
