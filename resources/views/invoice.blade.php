@extends('layouts.app')
@section('content')
<div class="container">
    <div class="status-container">
        <div class="status-circle success">
            <center><span>pilih metode pembayaran</span></center>
        </div>
        <div class="line {{$carts->status == 'success'? 'success' : 'default'}}"></div>
        <div class="status-circle {{$carts->status == 'success'? 'success' : 'default'}}">
            <center><span>verifikasi pembayaran</span></center>
        </div>
        <div class="line {{$carts->status == 'success'? 'success' : 'default'}}"></div>
        <div class="status-circle {{$carts->status == 'success'? 'success' : 'default'}}">
            <center><span>processing</span></center>
        </div>
        <div class="line {{$products['status'] == 'success'? 'success' : 'default'}}"></div>
        <div class="status-circle {{$products['status'] == 'success'? 'success' : 'default'}}">
            <center><span>success</span></center>
        </div>
    </div>
    {{-- <div class="status-container">
        <div class="status-circle success">
            <center><span>pilih metode pembayaran</span></center>
        </div>
        <div class="line {{$carts->status == 'success'? 'success' : 'default'}}"></div>
        <div class="status-circle {{$carts->status == 'success'? 'success' : 'default'}}">
            <center><span>verifikasi pembayaran</span></center>
        </div>
        <div class="line default"></div>
        <div class="status-circle default">
            <center><span>processing</span></center>
        </div>
        <div class="line default"></div>
        <div class="status-circle default">
            <center><span>success</span></center>
        </div>
    </div> --}}
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