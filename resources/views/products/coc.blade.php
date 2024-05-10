
@extends('layouts.topup')
@section('howto')
          <p>Cara Topup Clash of Clans<br>
            1. Masukkan User ID & Server ID<br>
            2. Pilih Nominal Topup<br>
            3. Pilih Metode Pembayaran<br>
            4. Klik Beli Sekarang & Lakukan Pembayaran<br>
            5. Tunggu Pembayaran Terverifikasi<br>
            6. Lalu Pesanan Masuk Secara Otomatis
          </p>
@endsection
@section('datagame')
        <input type="text" id="inputfield1" class="form-control mb-3" name="userid" placeholder="User ID">
        <input type="text" class="d-none" id="inputfield2" class="form-control" name="server" placeholder="Server ID">
@endsection
@section('items')
      <div class="row row-cols-3 row-cols-md-3 g-3">
        @php
          $found = false;
        @endphp
        @foreach ($product as $item)
          @if ($item['game'] == "Clash of Clans")
            @php
              $price = app('App\Http\Controllers\handlercontroller')->profit($item['price']['basic']);
              $found = true;
            @endphp
              <div class="col">
                <div class="card border border-primary card-hover" style=" cursor: pointer;" id="selectproduct" onclick="handleCardClick(this)">
                  <div class="card-body" style="padding: 0.5rem;position:relative;">
                    <div class="card-items">
                      <center><div class="img-item">
                        <img class="img-fluid rounded" src="{{ asset('storage/static/assets/coc.webp') }}" >
                      </div></center>
                      <div>
                          <p class="card-title fw-bold" style="font-size:10px;">{{ $item['name'] }}</p>
                          <p class="card-title fw-bold" style="font-size:10px;">Rp{{ number_format($price) }}</p>
                      </div>
                      <input type="checkbox" class="form-check-input d-none" name="selectedProduct" value="{{ $item['code'] }}">
                    </div>
                  </div>
                </div>
              </div>
          @endif
        @endforeach
      </div>
      @if (!$found)
        <div id="selectproduct" class="not-found"></div>
        <center><h5 class="fw-bold text-light-emphasis">Item tidak tersedia:(</h5></center>
      @endif
@endsection