@extends('layout.layoutUser')
@section('content')
    <head>
        <title>Kitsune Shop</title>
        <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
    </head>
    <div class="image-container">
        <img src="{{ asset('images/BocchiTheRockBackground1.png') }}" alt="Bocchi The Rock 1">
        <div class="overlay">
            <div class="text-box">
                <p class="small text-uppercase fw-bold">New Arrival</p>
                <h1>Discover Our New Collection</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.</p>
                <a href="{{ route('shop') }}"><button class="btn fw-bold btn-custom"><span>Buy Now</span></button></a>
            </div>
        </div>
    </div>

    <div class="content1" style="font-family: 'Poppins', sans-serif;">
        <div class="opening-browse text-center pt-5 mt-5" data-aos="fade-up">
            <h2 class="fw-bold">Browse The Range</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis praesentium alias asperiores voluptatibus dolorem tempora ad commodi fugit aut.</p>
        </div>
        <div class="image-browse pt-3 pb-5">
            <div class="d-flex justify-content-center gap-5">
                <div class="preview-image d-flex flex-column align-items-center" data-aos="zoom-in-right">
                    <a href="#"><img src="{{ asset('images/FushiguroMegumi.jpg') }}" alt="Kamen Rider Build" width="260px" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.586); border-radius: 15px;"></a>
                    <h5 class="pt-4 text-center fw-bold">Figma</h5>
                </div>
                <div class="preview-image d-flex flex-column align-items-center" data-aos="zoom-in">
                    <a href="#"><img src="{{ asset('images/ElainaMajoNoTabiTabi.jpg') }}" alt="Elaina Majo No Tabi Tabi" width="300px" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.586); border-radius: 15px;"></a>
                    <h5 class="pt-4 text-center fw-bold">Scaled Figure</h5>
                </div>
                <div class="preview-image d-flex flex-column align-items-center" data-aos="zoom-in-left">
                    <a href="#"><img src="{{ asset('images/HoshinoRubyOshiNoKO.png') }}" alt="Hoshino Ruby Oshi no Ko" width="265px" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.586); border-radius: 15px;"></a>
                    <h5 class="pt-4 text-center fw-bold">Nendoroid</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="content2 pb-5" style="font-family: 'Poppins', sans-serif;">
        <div class="our-products">
            <h2 class="fw-bold text-center pt-5" data-aos="fade-up">Our Products</h2>
            <div class="pt-3 pb-5 mt-4 rounded-3" style="box-shadow: 0 8px 12px rgba(0, 0, 0, 0.586); width: 90%; margin: 0 auto; background-color: #ff602b;" data-aos="zoom-in-up">
                @php
                    $limitedProducts = $products->take(8);
                @endphp
                @foreach ($limitedProducts->chunk(4) as $productChunk)
                    <div class="line d-flex justify-content-center pt-4 gap-4">
                        @foreach ($productChunk as $product)
                            <div class="d-flex flex-column rounded-3" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.284); width: 18%; height: auto;">
                                <a href="{{ route('shop.detailProduct', ['name' => $product->name]) }}" style="margin: 0 auto;">
                                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-top" width="100%" height="auto">
                                </a>
                                <div class="px-2 rounded-bottom" style="background-color: #F4F5F7">
                                    <a href="{{ route('shop.detailProduct', ['name' => $product->name] ) }}" style="text-decoration: none; color: black;">
                                        <h6 class="fw-bold pt-3 product-name">{{ $product->name }}</h6>
                                    </a>
                                    <h6 class="pb-2" style="color: #ff602b; font-size: 14px;">IDR {{ number_format($product->price, 0, ',', '.') }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <div class="d-flex justify-content-center pt-2 show-more" data-aos="fade-up">
                    <a href="{{ route('shop') }}">
                        <button class="btn fw-bold btn-show" style="background-color: black">
                            <span>Show More</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
