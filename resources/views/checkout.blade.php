@extends('layouts.app')
@section('content')
<div class="card mx-auto mt-5" style="width: 18rem;">
    <div class="card-header text-center text-white fw-bold bg-primary">
        Detail Pesanan
    </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item fw-bold">Order ID : {{$carts->order_id}}</li>
            <li class="list-group-item fw-bold">Kategori : {{$carts->category}}</li>
            <li class="list-group-item fw-bold">Produk : {{$carts->name}}</li>
            <li class="list-group-item fw-bold">Harga : Rp{{number_format($carts->price) }}</li>
            <li class="list-group-item fw-bold">Jumlah : {{$carts->quantity}}</li>
            @if ($carts->status == 'pending')
                <li class="list-group-item fw-bold">Status Pembayaran : <button type="button" class="btn btn-danger" style="cursor:none">{{ $carts->status }}</button></li>
            @else
                <li class="list-group-item fw-bold">Status Pembayaran : <button type="button" class="btn btn-success" style="cursor:none">{{ $carts->status }}</button></li>
            @endif
            <div class="card-header text-center fw-bold bg-primary text-white">
                Informasi Akun
            </div>
            <li class="list-group-item fw-bold">User ID : {{ $carts->user_id }}</li>
            <li class="list-group-item fw-bold">Server ID : {{ $carts->server_id }}</li>
        </ul>
</div>
<br>
<center><button type="button" id="pay-button" class="btn btn-primary" style="width:18rem;">Beli Sekarang</button></center>
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        window.snap.pay('{{ $token }}', {
        uiMode: "qr",
        onSuccess: function(result){
            window.location.href = '/order/checkout/invoice/{{ $carts->order_id }}';
        },
        onPending: function(result){
            alert("waiting your payment!");
        },
        onError: function(result){
            alert("payment failed!");
        },
        onClose: function(){
            alert('you closed the popup without finishing the payment');
        }
        })
    });
</script>
@endsection