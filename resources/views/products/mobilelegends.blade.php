@extends('layouts.app')

@section('content')

<br><br>

<div class="container">

  <form action="/order/{{$order_id}}" method="POST" onsubmit="return validateform(this)">

    @csrf

    <div class="topup">

      <div class="section-split">

        <div class="section-banner">

          <div class="banner-item">

            <div class="slider-container">

                <div class="slider">

                    <div class="slide">

                        <img class=" img-fluid rounded" src="{{ asset('storage/static/assets/banner1.webp') }}" alt="Slide 1">

                    </div>

                    <div class="slide">

                        <img class="img-fluid rounded"  src="{{ asset('storage/static/assets/banner2.webp') }}" alt="Slide 2">

                    </div>

                </div>

            </div>

            <div class="slideButton">

              <div class="prev-item" onclick="prevSlide()">&#10094;</div>

              <div class="next-item" onclick="nextSlide()">&#10095;</div>

            </div>

          </div>

        </div>

        <div class="section-howto mt-3 fw-bold text-light-emphasis">

          <p>Cara Topup Mobile Legends<br>

            1. Masukkan User ID & Server ID<br>

            2. Pilih Nominal Topup<br>

            3. Pilih Metode Pembayaran<br>

            4. Klik Beli Sekarang & Lakukan Pembayaran<br>

            5. Tunggu Pembayaran Terverifikasi<br>

            6. Lalu Pesanan Masuk Secara Otomatis

          </p>

        </div>

      </div>

      <div class="section-item">

        <div class="title-item">

          <div class="d-flex">

            <div class="bg-primary rounded" style="width:30px;height:30px;">

              <p class="text-center text-light fw-bold" style="font-size:19px">1</p>

            </div>

            <div class="mb-3 mx-2">

              <label class="form-label text-light-emphasis fw-bold">Lengkapi Data Game</label>

            </div>

          </div>

          <div class="mb-5">

            <input type="text" id="inputfield1" class="form-control mb-3" name="userid" placeholder="User ID">

            <input type="text" id="inputfield2" class="form-control" name="server" placeholder="Server ID">
            <br>
            <p class="fw-bold text-light-emphasis">Username : <span class="fst-italic" id="checkedId"></span></p>
            <button type="button" class="btn btn-primary" onclick="CheckUsername('MOBILE_LEGENDS')">Cek username</button>
          </div>

        </div>

        <div class="d-flex mb-3" style="background-color: rgb(212, 229, 255);">

          <div class="bg-primary rounded" style="width:30px;height:30px;">

            <p class="text-center text-light fw-bold" style="font-size:19px">2</p>

          </div>

          <div class="mx-2">

            <label class="form-label text-light-emphasis fw-bold">Pilih Nominal</label>

          </div>

        </div>

        <div class="item rounded">

          <div class="items">

            <div class="row row-cols-3 row-cols-md-3 g-3">

              @foreach ($product as $item)

                  @if ($item['category'] == "Mobile Legends")

                    @php

                      #$untung = $item['price']['special'] * 0.07; #api thirdparty

                      #$price = $item['price']['special'] + $untung; #api thirdparty

                      $untung = $item['price'] * 0.07; #database

                      $price = $item['price'] + $untung; #database

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

                              <input type="checkbox" class="form-check-input d-none" name="selectedProduct" value="{{ $item['id'] }}">

                            </div>

                          </div>

                        </div>

                      </div>

                  @endif

              @endforeach

            </div>

          </div>

        </div>

        {{-- <div class="payment">

          <Div class="card payment1">

            <div class="card-body d-flex align-content-center">

              <img src="{{ asset('storage/static/assets/metode-pembayaran/wallet.png') }}" width="25" height="25">

              <h5 class="text-light-emphasis fw-bold mx-2">E-wallet atau Qris</h5>

            </div>

            <div class=" rounded d-flex text-bg-secondary" style="padding-top: 2rem ; padding: 2rem">

                <img src="{{ asset('storage/static/assets/metode-pembayaran/qris.png') }}" width="50" height="20"/>

                <img src="{{ asset('storage/static/assets/metode-pembayaran/dana.png') }}" width="55" height="20">

                <img src="{{ asset('storage/static/assets/metode-pembayaran/linkaja.png') }}" width="50" height="20">

                <img src="{{ asset('storage/static/assets/metode-pembayaran/ovo.png') }}" width="50" height="20">

                <img src="{{ asset('storage/static/assets/metode-pembayaran/shopeepay.png') }}" width="55" height="20">

            </div>

          </Div>

        </div> --}}

      </div>

    </div>

    <center><button type="submit" class="btn btn-primary mb-1" style="width:100%;">Beli Sekarang</button></center>

  </form>

</div>

@endsection