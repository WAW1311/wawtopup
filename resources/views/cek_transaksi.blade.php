@extends('layouts.app')

@section('content')
<center><div class="container">
        <form action="/cek-transaksi" method="post">
            @csrf
            <br>
            @if (session()->has('error'))       
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
    
                    {{ session('error') }}
    
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    
                </div>
            @endif
    
            <label class="form-label" for="trx">Masukan Order ID</label>
    
            <input type="text" class="form-control w-50" id="trx" name="order_id" placeholder="order id..." required>
    
            <br>
    
            <button type="submit" class=" mx-3 btn btn-primary">Cari Transaksi</button>
    
        </form>
</div></center>

@endsection