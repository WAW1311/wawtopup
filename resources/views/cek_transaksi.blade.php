@extends('layouts.app')
@section('content')
    <form action="/cek-transaksi" method="post">
        @csrf
        <br>
        <center><label class="form-label" for="trx">Masukan Order ID</label></center>
        <center><input type="text" class="form-control w-50" id="trx" name="order_id" placeholder="order id..."/></center>
        <br>
        <center><button type="submit" class=" mx-3 btn btn-primary">Cari Transaksi</button></center>
    </form>
    <br>
    <div class="table-responsive">
        <table class="table table-primary table-striped">
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
            <tbody>
            <tr>
                @if ($cart ?? false)
                    <td>{{$cart->order_id}}</td>
                    <td>{{$cart->product_id}}</td>
                    <td>{{$cart->category}}</td>
                    <td>{{$cart->name}}</td>
                    <td>{{$cart->price}}</td>
                    <td>{{$cart->quantity}}</td>
                    <td>{{$cart->user_id}}</td>
                    <td>{{$cart->server_id}}</td>
                    @if ($cart->status == 'pending')
                        <td><button type="button" class="btn btn-primary" style="cursor: none;">{{$cart->status}}</button></td>
                    @elseif ($cart->status == 'success')
                        <td><button type="button" class="btn btn-success" style="cursor: none;">{{$cart->status}}</button></td>
                    @else
                        <td><button type="button" class="btn btn-danger" style="cursor: none;">{{$cart->status}}</button></td>
                    @endif
                @endif
            </tr>
            </tbody>
        </table>
    </div>
@endsection