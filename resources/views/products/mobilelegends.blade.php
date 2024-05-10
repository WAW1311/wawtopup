@extends('layouts.topup')
@section('howto')
        <p>Cara Topup Mobile Legends<br>
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
              <input type="text" id="inputfield2" class="form-control" name="server" placeholder="Server ID">
              <br>
              <div class="username-wrapper">
                <div><p class="fw-bold text-light-emphassis">Username : <span class="fst-italic" id="checkedId"></span></p></div>
                <div class=" mx-2">
                <span class="fst-italic hidden" id="loading"></span>
                </div>
              </div>
              <button type="button" class="btn btn-primary" onclick="CheckUsername('MOBILE_LEGENDS')">Cek username</button>
@endsection
@section('items')
        <div class="row row-cols-3 row-cols-md-3 g-3">
          @php
            $found = false;
          @endphp
          @foreach ($product as $item)
              @if ($item['game'] == "Mobile Legends B")
                @php
                  $price = app('App\Http\Controllers\handlercontroller')->profit($item['price']['basic']);
                  $found = true;
                @endphp
                  <div class="col">
                    <div class="card border border-primary card-hover" id="selectproduct" style=" cursor: pointer;" onclick="handleCardClick(this)">
                      <div class="card-body" style="padding: 0.5rem;position:relative;">
                        <div class="card-items">
                          <center><div class="img-item">
                            <img class="img-fluid rounded" src="{{ asset('storage/static/assets/dm.webp') }}" >
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
