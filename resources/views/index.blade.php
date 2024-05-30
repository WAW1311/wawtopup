@extends('layouts.app')
@section('content')
    <div class="banner mx-auto">
        <div class="slider-container rounded-3">
            <div class="slider" >
                <div class="slide" >
                    <img class=" img-fluid rounded-3" src="{{ asset('storage/static/assets/banner1.webp') }}" alt="Slide 1">
                </div>
                <div class="slide">
                    <img class="img-fluid rounded-3"  src="{{ asset('storage/static/assets/banner2.webp') }}" alt="Slide 2">
                </div>
            </div>
        </div>
        <div  class="buttonslide">
            <div class="prev" onclick="prevSlide()">&#10094;</div>
            <div class="next" onclick="nextSlide()">&#10095;</div>
        </div>
    </div>
    <div class="product bg-light mb-4 rounded-3">
        <ul class="fw-bold nav nav-underline justify-content-evenly py-3" id="category" role="tablist">
            @foreach ($categories as $category)
                <li class="nav-item px-3 rounded" role="presentation">
                    <button class="text-decoration-none nav-link {{ $loop->first ? 'active' : '' }}" id="pills-{{ $category->name }}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{ $category->name }}" type="button" role="tab" aria-controls="pills-{{ $category->name }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $category->name }}</button>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-content" id="CategoryContent">
        @foreach ($categories as $category)
            <div class="text-decoration-none product tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pills-{{ $category->name }}" role="tabpanel" aria-labelledby="pills-{{ $category->name }}-tab" tabindex="0">
                <div class="row row-cols-3 row-cols-md-6 g-2">
                    @foreach ($category->product as $product)
                        @foreach ($product->sub_product as $sub_products)
                            <div class="col patokan">
                                <a href="{{ route('sub_product', ['href' => $sub_products->href]) }}" class="text-decoration-none">
                                    <div class="card" style="background:transparent; border:none">
                                        <img src="{{ asset('storage/' . $product->src) }}" class="img-product card-img-top rounded" alt="{{ $product->name }}">
                                        <div class="card" style="top:-70px;">
                                            <div class="card-body text-center" style="margin-top:70px;">
                                                <h5 class="card-title text-light-emphasis fw-bold" style="font-size:12px;">{{ $product->name }}</h5>
                                                <button type="submit" class="btn fw-bold btn-primary" style="width: 100%; font-size:12px;">Top Up</button>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
        {{-- <div class="product bg-light mb-4 rounded-3">
            <ul class="fw-bold nav nav-underline justify-content-evenly py-3" id="category" role="tablist">
                <li class="nav-item px-3 rounded" role="presentation">
                    <button class="text-decoration-none nav-link active" id="pills-games-tab" data-bs-toggle="pill" data-bs-target="#pills-games" type="button" role="tab" aria-controls="pills-games" aria-selected="true">Games</button>
                </li>
                <li class="nav-item px-3 rounded" role="presentation">
                    <button class="text-decoration-none nav-link" id="pills-streaming-tab" data-bs-toggle="pill" data-bs-target="#pills-streaming" type="button" role="tab" aria-controls="pills-streaming" aria-selected="false">Streaming</button>
                </li>
                <li class="nav-item px-3 rounded" role="presentation">
                    <button class="text-decoration-none nav-link" id="pills-vouchers-tab" data-bs-toggle="pill" data-bs-target="#pills-vouchers" type="button" role="tab" aria-controls="pills-vouchers" aria-selected="false">Vouchers</button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="CategoryContent">
            <div class="text-decoration-none product tab-pane fade show active" id="pills-games" role="tabpanel" aria-labelledby="pills-games-tab" tabindex="0">
                <div class="row row-cols-3 row-cols-md-4 g-2">
                    @foreach ($sub_product as $sub_products)
                        @if ($sub_products->product->id_category == 1)
                            <div class="col patokan">
                                <a href="{{route('sub_product',['href'=>$sub_products->href]) }}" class="text-decoration-none"><div class="card" style="background:transparent; border:none">
                                    <img src="{{ asset('storage/' . $sub_products->product->src) }}" class="img-product card-img-top rounded" alt="{{ $sub_products->product->name }}">
                                    <div class="card"style="top:-70px;">
                                        <div class="card-body text-center" style="margin-top:70px;">
                                            <h5 class="card-title text-light-emphasis fw-bold" style="font-size:12px;">{{ $sub_products->product->name }}</h5>
                                            <button type="submit" class="btn fw-bold btn-primary" style="width: 100%; font-size:12px;">Top Up</button>
                                        </div>
                                    </div>
                                </div></a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="text-decoration-none product tab-pane fade" id="pills-streaming" role="tabpanel" aria-labelledby="pills-streaming-tab" tabindex="0">
            <div class="row row-cols-3 row-cols-md-4 g-2">
                    @foreach ($sub_product as $sub_products)
                        @if ($sub_products->product->id_category == 2)
                            <div class="col patokan">
                                <a href="{{route('sub_product',['href'=>$sub_products->href]) }}" class="text-decoration-none"><div class="card" style="background:transparent; border:none">
                                    <img src="{{ asset('storage/' . $sub_products->product->src) }}" class="img-product card-img-top rounded" alt="{{ $sub_products->product->name }}">
                                    <div class="card"style="top:-70px;">
                                        <div class="card-body text-center" style="margin-top:70px;">
                                            <h5 class="card-title text-light-emphasis fw-bold" style="font-size:12px;">{{ $sub_products->product->name }}</h5>
                                            <button type="submit" class="btn fw-bold btn-primary" style="width: 100%; font-size:12px;">Top Up</button>
                                        </div>
                                    </div>
                                </div></a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="text-decoration-none product tab-pane fade" id="pills-vouchers" role="tabpanel" aria-labelledby="pills-vouchers-tab" tabindex="0">
            <div class="row row-cols-3 row-cols-md-4 g-2">
                    @foreach ($sub_product as $sub_products)
                        @if ($sub_products->product->id_category == 3)
                            <div class="col patokan">
                                <a href="{{route('sub_product',['href'=>$sub_products->href]) }}" class="text-decoration-none"><div class="card" style="background:transparent; border:none">
                                    <img src="{{ asset('storage/' . $sub_products->product->src) }}" class="img-product card-img-top rounded" alt="{{ $sub_products->product->name }}">
                                    <div class="card"style="top:-70px;">
                                        <div class="card-body text-center" style="margin-top:70px;">
                                            <h5 class="card-title text-light-emphasis fw-bold" style="font-size:12px;">{{ $sub_products->product->name }}</h5>
                                            <button type="submit" class="btn fw-bold btn-primary" style="width: 100%; font-size:12px;">Top Up</button>
                                        </div>
                                    </div>
                                </div></a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div> --}}
@endsection