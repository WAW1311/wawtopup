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
              @if ($item['game'] == $sub_product->name)
                @php
                  $price = app('App\Http\Controllers\handlercontroller')->profit($item['price']['basic']);
                  $found = true;
                @endphp
                  <div class="col">
                    <div class="card border border-primary card-hover" id="selectproduct" style=" cursor: pointer;" onclick="handleCardClick(this)">
                      <div class="card-body" style="padding: 0.5rem;position:relative;">
                        <div class="card-items">
                          <center><div class="img-item">
                            <img class="img-fluid rounded" src="{{ asset('storage/'.$sub_product->assets) }}" >
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
