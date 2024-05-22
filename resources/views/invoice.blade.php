@extends('layouts.app')
@section('content')
{{-- <div class="card mx-auto mt-5" style="width: 18rem;">
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
             <div class="card-header text-center fw-bold bg-primary text-white">
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
            @endif 
        </ul>
</div> --}}
<div class="container">
    <div class="status-container mt-3">
        <div class="status-circle success">
            <center><span>pilih metode pembayaran</span></center>
        </div>
        <div class="line success"></div>
        <div class="status-circle default {{$carts->status == 'success'? 'success' : 'default'}}">
            <center><span>verifikasi pembayaran</span></center>
        </div>
        <div class="line {{$carts->status == 'success'? 'success' : 'default'}}"></div>
        <div class="status-circle default">
            <center><span>proccessing</span></center>
        </div>
        <div class="line"></div>
        <div class="status-circle default">
            <center><span>success</span></center>
        </div>
    </div>
    <div class="card mx-auto mt-3 mb-5" style="width: 100%;">
        <div class="card-header text-white fw-bold bg-primary">
            INVOICE #{{$carts->order_id}}
        </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item fw-bold d-flex justify-content-between align-items-center">Order ID  :<span class="text-end">{{$carts->order_id}}</span></li>
                <li class="list-group-item fw-bold d-flex justify-content-between align-items-center">Kategori  :<span class="text-end">{{$carts->category}}</span></li>
                <li class="list-group-item fw-bold d-flex justify-content-between align-items-center">Produk    :<span class="text-end">{{$carts->name}}</span></li>
                <li class="list-group-item fw-bold d-flex justify-content-between align-items-center">User ID          :<span class="text-end">{{ $carts->user_id }}</span></li>
                <li class="list-group-item fw-bold d-flex justify-content-between align-items-center">Server ID        :<span class="text-end">{{ $carts->server_id }}</span></li>
                <div class="card-header text-center fw-bold bg-primary text-white">
                    Detail pembayaran
                </div>
                <li class="list-group-item fw-bold d-flex justify-content-between align-items-center">Harga     :<span class="text-end">Rp{{number_format($carts->price) }}</span></li>
                <li class="list-group-item fw-bold d-flex justify-content-between align-items-center">Jumlah    :<span class="text-end">{{$carts->quantity}}</span></li>
                <li class="list-group-item fw-bold d-flex justify-content-between align-items-center">Subtotal    :<span class="text-end">Rp{{number_format($carts->price) }}</span></li>
                <li class="list-group-item fw-bold d-flex justify-content-between align-items-center">Metode Pembayaran    :<span class="text-end">{{ $carts->payment_method }}</span></li>
                @if ($carts->status == 'success')
                <li class="list-group-item fw-bold  d-flex justify-content-between align-items-center">Status Pembayaran : <span class="text-end"><button type="button" class="btn btn-success" style="cursor:none">{{ $carts->status }}</button></span></li>
                @else
                <li class="list-group-item fw-bold  d-flex justify-content-between align-items-center">Status Pembayaran : <span class="text-end"><button type="button" class="btn btn-danger" style="cursor:none">{{ $carts->status }}</button></span></li>
                @endif
            </ul>
    </div>
</div>

@endsection