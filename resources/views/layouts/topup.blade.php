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
                        <img class=" img-fluid rounded" style="border-radius: 20px;" src="{{ asset('storage/static/assets/banner1.webp') }}" alt="Slide 1">
                    </div>
                    <div class="slide">
                        <img class="img-fluid rounded" style="border-radius: 20px;" src="{{ asset('storage/static/assets/banner2.webp') }}" alt="Slide 2">
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
          @yield('howto')
        </div>
      </div>
      <div class="section-item">
        <div class="bg-light rounded mb-5" style="width: 100%; padding:2rem;">
          <div class="title-item">
            <div class="d-flex">
              <div class="bg-primary rounded" style="width:30px;height:30px;">
                <p class="text-center text-light fw-bold" style="font-size:19px">1</p>
              </div>
              <div class="mb-3 mx-2">
                <label class="form-label text-light-emphasis fw-bold">Lengkapi Data Game</label>
              </div>
            </div>
            <div class="mb-0">
              <div class="datagame">
                @yield('datagame')
              </div>
            </div>
          </div>
        </div>
        <div class="item bg-light rounded">
          <div class="d-flex" style="width: 100%; padding:2rem;">
            <div class="bg-primary rounded" style="width:30px;height:30px;">
              <p class="text-center text-light fw-bold" style="font-size:19px">2</p>
            </div>
            <div class="mx-2">
              <label class="form-label text-light-emphasis fw-bold">Pilih Nominal</label>
            </div>
          </div>
          <div class="items rounded border border-light-emphasis" style="height: 400px; overflow-y: auto;">
                  @yield('items')
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
        <div class="bg-light rounded mt-3" style="width: 100%; padding:2rem;">
          <div class="title-item">
            <div class="d-flex">
              <div class="bg-primary rounded" style="width:30px;height:30px;">
                <p class="text-center text-light fw-bold" style="font-size:19px">3</p>
              </div>
              <div class="mb-3 mx-2">
                <label class="form-label text-light-emphasis fw-bold">Masukan Nomor Whatsapp Aktif</label>
              </div>
            </div>
            <div class="mb-0">
              <input type="text" id="nohp" name="nohp" class="form-control" placeholder="Contoh: 08123xxx...">
            </div>
          </div>
        </div>
      </div>
    </div>
    <center><button type="submit" class="btn btn-primary mt-3 mb-5" style="width:100%;">Beli Sekarang</button></center>
  </form>
</div>
@endsection