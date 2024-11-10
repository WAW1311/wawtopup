@extends('layouts.topup')
@section('howto')
        <p>{!! $sub_product->howto !!}</p>
@endsection
@section('datagame')
              <div>
                {!!$sub_product->fill_data_id !!}
              </div>
              <br>
              @if ($sub_product->checkign_on == false)
              <div class="username-wrapper d-none">
                <div><p class="fw-bold text-light-emphassis">Username : <span class="fst-italic" id="checkedId"></span></p></div>
                <div class=" mx-2">
                <span class="fst-italic hidden" id="loading"></span>
                </div>
              </div>
              <button type="button" class="d-none btn btn-primary" onclick="CheckUsername('{{$sub_product->checkign}}')">Cek username</button>
              @else
                <div class="username-wrapper">
                  <div><p class="fw-bold text-light-emphassis">Username : <span class="fst-italic" id="checkedId"></span></p></div>
                  <div class=" mx-2">
                  <span class="fst-italic hidden" id="loading"></span>
                  </div>
                </div>
                <button type="button" class="btn btn-primary" onclick="CheckUsername('{{$sub_product->checkign}}')">Cek username</button>
              @endif
@endsection
@section('items')
        <div class="row row-cols-3 row-cols-md-3 g-3">
          @php
            $found = false;
          @endphp
          @foreach ($product as $item)
              @if ($item->game == $sub_product->name)
                @php
                  $price = app('App\Http\Controllers\handlercontroller')->profit($item->price);
                  $found = true;
                @endphp
                  <div class="col">
                    <div class="card border border-primary card-hover" style=" cursor: pointer;" onclick="handleCardClick(this)">
                      <div class="card-body" style="padding: 0.5rem;position:relative;">
                        <div class="card-items">
                          <center><div class="img-item">
                            <img class="img-fluid rounded" src="{{ asset('storage/'.$sub_product->assets) }}" >
                          </div></center>
                          <div>
                              <p class="card-title fw-bold" style="font-size:10px;">{{ $item->name }}</p>
                              <p class="card-title fw-bold" style="font-size:10px;">Rp{{ number_format($price) }}</p>
                              <p id="product_price" class="d-none">{{$price}}</p>
                          </div>
                          <input type="checkbox" class="selectproduct form-check-input d-none" name="selectedProduct" value="{{ $item->code }}">
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
@section('payment')
<div class="payment-section">
    <div class="payment1">
        <div class="bg-white border rounded">
            <div class="p-3 d-flex">
                <img src="{{ asset('storage/static/assets/metode-pembayaran/wallet.png') }}" width="30" height="25">
                <p class="text-light-emphasis fw-bold mx-2">E-wallet atau Qris</p>
                <div class="navi" style="cursor:pointer;" onclick="getpayment('payment1')">&#9660;</div>
            </div>
            <div class="d-none mpay py-3 rounded-bottom justify-content-around text-bg-secondary">
                @foreach ($payment->data as $payments)
                    @if ($payments->group == 'E-Wallet' && $payments->active == true)
                        <div class="childmpay bg-white border rounded p-3" style="width:7rem; height: 6rem;cursor:pointer;" onclick="selectpayment(this)">
                                <div class="pb-3 px-3"><img src="{{$payments->icon_url}}" class="img-fluid"/></div>
                                <p class="text-light-emphasis" style="font-size:1rem;">Rp <span id="price">0</span></p>
                                <p id="code_payment" class="d-none">{{$payments->code}}</p>
                                <input type="checkbox" name="selectedpayment" class="selectpayment d-none" value="{{ $payments->code }}">
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="cpay rounded-bottom d-flex justify-content-end text-bg-secondary" style="padding: 0.5rem">
                <div class="justify-content-between">
                    @foreach ($payment->data as $payments)
                        @if ($payments->group == 'E-Wallet' && $payments->active == true)
                            <img src="{{$payments->icon_url}}" id="{{$payments->code}}" width="60" height="20">
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="payment2 mt-3">
        <div class="bg-white border rounded">
            <div class="p-3 d-flex">
                <img src="{{ asset('storage/static/assets/metode-pembayaran/bank.png') }}" width="30" height="25">
                <p class="text-light-emphasis fw-bold mx-2">Virtual Account</p>
                <div class="navi" style="cursor:pointer;" onclick="getpayment('payment2')">&#9660;</div>
            </div>
            <div class="d-none mpay py-3 rounded-bottom justify-content-around text-bg-secondary">
                @foreach ($payment->data as $payments)
                    @if ($payments->group == 'Virtual Account' && $payments->active == true)
                        <div class="childmpay bg-white border rounded p-3" style="width:7rem; height: 6rem;cursor:pointer;" onclick="selectpayment(this)">
                                <div class="pb-3 px-3"><img src="{{$payments->icon_url}}" class="img-fluid"/></div>
                                <p class="text-light-emphasis" style="font-size:1rem;">Rp <span id="price">0</span></p>
                                <p id="code_payment" class="d-none">{{$payments->code}}</p>
                                <input type="checkbox" name="selectedpayment" class="selectpayment d-none" value="{{ $payments->code }}">
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="cpay rounded-bottom d-flex justify-content-end text-bg-secondary" style="padding: 0.5rem">
                <div class="justify-content-between">
                    @foreach ($payment->data as $payments)
                        @if ($payments->group == 'Virtual Account' && $payments->active == true)
                            <img src="{{$payments->icon_url}}" width="60" height="20">
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
