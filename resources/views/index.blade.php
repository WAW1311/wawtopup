@extends('layouts.app')
@section('content')
    <div class="banner mt-3 mx-auto">
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
    <div class="section-title mt-5 mx-auto">
        <div class="section-strip rounded bg-primary"></div>
        <h4 class="mx-3 text-primary fw-bold">Populer</h4>
    </div>
    <div class="product mt-5">
        <div class="row row-cols-3 row-cols-md-4 g-2">
            @foreach ($sub_product as $sub_products)
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
            @endforeach
        </div>
    </div>
@endsection