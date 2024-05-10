@extends('layouts.app')
@section('content')
<div class="card mx-auto mt-5" style="width: 18rem;">
    <div class="card-header text-center text-white fw-bold bg-primary">
        invoice
    </div>
        <ul class="mb-3 list-group list-group-flush">
            <li class="list-group-item fw-bold">Order ID : {{$carts->order_id}}</li>
            <li class="list-group-item fw-bold">Kategori : {{$carts->category}}</li>
            <li class="list-group-item fw-bold">Produk : {{$carts->name}}</li>
            <li class="list-group-item fw-bold">Harga : {{$carts->price }}</li>
            <li class="list-group-item fw-bold">Jumlah : {{$carts->quantity}}</li>
            @if ($carts->status == 'success')
                <li class="list-group-item fw-bold">Status Pembayaran : <button type="button" class="btn btn-success" style="cursor:none">{{ $carts->status }}</button></li>
            @else
                <li class="list-group-item fw-bold">Status Pembayaran : <button type="button" class="btn btn-danger" style="cursor:none">{{ $carts->status }}</button></li>
            @endif
            {{-- <div class="card-header text-center fw-bold bg-primary text-white">
                Informasi Akun & Status Pengiriman
            </div>
            <li class="list-group-item fw-bold">User ID : {{ $carts->user_id }}</li>
            <li class="list-group-item fw-bold">Server ID : {{ $carts->server_id }}</li>
            
            @if ($products['status'] == 'success')
                <li class="list-group-item fw-bold">Status Pengiriman : <button type="button" class="btn btn-success" style="cursor:none">{{ $products['status'] }}</button></li>
            @elseif($products['status'] == 'processing')
                <li class="list-group-item fw-bold">Status Pengiriman : <button type="button" class="btn btn-primary" style="cursor:none">{{ $products['status'] }}</button></li>
            @else
                <li class="list-group-item fw-bold">Status Pengiriman : <button type="button" class="btn btn-danger" style="cursor:none">{{ $products['status'] }}</button></li>
            @endif --}}
        </ul>
</div>
@endsection