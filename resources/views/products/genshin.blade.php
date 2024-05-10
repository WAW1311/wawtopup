@extends('layouts.topup')
@section('howto')
          <p>Cara Topup Genshin Impact<br>
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
            <input class="d-none" type="text" id="inputfield2" class="form-control" name="server" placeholder="Server ID">
            <div class="username-wrapper">
              <div><p class="fw-bold text-light-emphasis">Username : <span class="fst-italic" id="checkedId"></span></p></div>
              <div class=" mx-2">
              <span class="fst-italic hidden" id="loading"></span>
              </div>
            </div>
            <button type="button" class="btn btn-primary" onclick="CheckUsername('GENSHIN_IMPACT')">Cek username</button>
@endsection
@section('items')
          <div class="row row-cols-3 row-cols-md-3 g-3">
            @php
              $found = false;
            @endphp
            @foreach ($product as $item)
                @if ($item['game'] == "Genshin Impact")
                  @php
                    $price = app('App\Http\Controllers\handlercontroller')->profit($item['price']['basic']);
                    $found = true;
                  @endphp
                    <div class="col">
                      <div class="card border border-primary card-hover" style=" cursor: pointer;" id="selectproduct" onclick="handleCardClick(this)">
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