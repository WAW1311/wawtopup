@extends('layouts.app')

@section('content')

<div class="container">

    <div class="status-container">

        <div class="status-circle success">

            <center><span>pilih metode pembayaran</span></center>

        </div>

        <div class="line"></div>

        <div class="status-circle default">

            <center><span>verifikasi pembayaran</span></center>

        </div>

        <div class="line"></div>

        <div class="status-circle default">

            <center><span>proccessing</span></center>

        </div>

        <div class="line"></div>

        <div class="status-circle default">

            <center><span>success</span></center>

        </div>

    </div>

    <div class="card mx-auto mt-3" style="width: 100%;">

        <div class="card-header text-center text-white fw-bold bg-primary">

            Detail Pesanan

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

            </ul>

    </div>

    <br>

    <button type="button" id="pay-button" class="btn btn-primary mb-3 fw-bold" style="width:100%;">Checkout</button>

</div>

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