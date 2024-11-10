@extends('layouts.app')
@section('content')
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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="bg-light rounded mb-5 shadow" style="width: 100%; padding:2rem;">
          <div class="title-item">
            <div class="d-flex">
              <div class="bg-primary rounded" style="width:30px;height:30px;">
                <p class="text-center text-light fw-bold" style="font-size:19px">1</p>
              </div>
              <div class="mb-3 mx-2">
                <label class="form-label text-light-emphasis fw-bold">Lengkapi Data</label>
              </div>
            </div>
            <div class="mb-0">
              <div class="datagame">
                @yield('datagame')
              </div>
            </div>
          </div>
        </div>
        <div class="item bg-light rounded shadow">
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
        <div class="bg-light rounded mt-3 shadow" style="width: 100%; padding:2rem;">
          <div class="title-item">
            <div class="d-flex">
              <div class="bg-primary rounded" style="width:30px;height:30px;">
                <p class="text-center text-light fw-bold" style="font-size:19px">3</p>
              </div>
              <div class="mb-3 mx-2">
                <label class="form-label text-light-emphasis fw-bold">Pilih Metode Pembayaran</label>
              </div>
            </div>
            <div class="mb-0">
              @yield('payment')
            </div>
          </div>
        </div>
        <div class="bg-light rounded mt-3 shadow" style="width: 100%; padding:2rem;">
          <div class="title-item">
            <div class="d-flex">
              <div class="bg-primary rounded" style="width:30px;height:30px;">
                <p class="text-center text-light fw-bold" style="font-size:19px">4</p>
              </div>
              <div class="mb-3 mx-2">
                <label class="form-label text-light-emphasis fw-bold">Masukan Nomor Whatsapp Aktif</label>
              </div>
            </div>
            <div class="mb-0">
              <input type="text" id="nohp" name="nohp" class="form-control" placeholder="Contoh: 08123xxx..." required>
            </div>
          </div>
        </div>
      </div>
    </div>
    <center><button type="submit" class="btn btn-primary mt-3 mb-5" style="width:100%;">Beli Sekarang</button></center>
  </form>
</div>
@endsection