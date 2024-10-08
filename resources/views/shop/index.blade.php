@extends('layout.layoutUser')
@section('content')
    <head>
        <title>Shop</title>
        <link rel="stylesheet" href="{{ asset('css/styleShop.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    </head>
    <div class="content-container">
        <svg class="pt-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <defs>
                <filter id="waveShadow" x="0" y="0">
                    <feDropShadow dx="0" dy="10" stdDeviation="10" flood-color="rgba(0, 0, 0, 0.5)" />
                </filter>
            </defs>
            <path filter="url(#waveShadow)" fill="#ff602bdb" fill-opacity="1.5" d="M0,256L21.8,245.3C43.6,235,87,213,131,186.7C174.5,160,218,128,262,128C305.5,128,349,160,393,170.7C436.4,181,480,171,524,186.7C567.3,203,611,245,655,256C698.2,267,742,245,785,240C829.1,235,873,245,916,256C960,267,1004,277,1047,245.3C1090.9,213,1135,139,1178,133.3C1221.8,128,1265,192,1309,218.7C1352.7,245,1396,235,1418,229.3L1440,224L1440,0L1418.2,0C1396.4,0,1353,0,1309,0C1265.5,0,1222,0,1178,0C1134.5,0,1091,0,1047,0C1003.6,0,960,0,916,0C872.7,0,829,0,785,0C741.8,0,698,0,655,0C610.9,0,567,0,524,0C480,0,436,0,393,0C349.1,0,305,0,262,0C218.2,0,175,0,131,0C87.3,0,44,0,22,0L0,0Z"></path>
        </svg>
        <div class="overlay">
            <div class="text-box pb-5">
                <h1>Shop</h1>
                <p class="pt-2" style="color: white"><a class="fw-bold" href="{{ route('home') }}">Home</a> > Shop</p>
            </div>
        </div>
    </div>

    <div class="content2 pb-3" style="font-family: 'Poppins', sans-serif;">
        <div class="our-products">
            <h2 class="fw-bold text-center pt-5" data-aos="fade-up">Our Products</h2>
            <div class="pt-3 pb-5 mt-4 rounded-3 products-container" style="box-shadow: 0 8px 12px rgba(0, 0, 0, 0.586); width: 90%; margin: 0 auto; background-color: #ff602b;" data-aos="zoom-in-up">
                @php
                    $chunks = $products->chunk(4);
                @endphp
                @foreach ($chunks as $chunkIndex => $productChunk)
                    <div class="line d-flex justify-content-center pt-4 gap-4 {{ $chunkIndex >= 2 ? 'd-none product-chunk' : '' }}">
                        @foreach ($productChunk as $product)
                            <div class="d-flex flex-column rounded-3" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.284); width: 18%; height: auto;">
                                <a href="{{ route('shop.detailProduct', ['name' => $product->name]) }}" style="margin: 0 auto;">
                                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-top" width="100%" height="auto">
                                </a>
                                <div class="px-2 rounded-bottom" style="background-color: #F4F5F7;">
                                    <a href="{{ route('shop.detailProduct', ['name' => $product->name]) }}" style="text-decoration: none; color: black;">
                                        <h6 class="fw-bold pt-3 product-name">{{ $product->name }}</h6>
                                    </a>
                                    <h6 class="pb-2" style="color: #ff602b; font-size: 14px;">IDR {{ number_format($product->price, 0, ',', '.') }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                @if ($chunks->count() > 2)
                    <div class="d-flex justify-content-center pt-2 show-more" data-aos="fade-up">
                        <button class="btn fw-bold btn-show" style="background-color: black">
                            <span>Show More</span>
                        </button>
                        <span class="loading-text d-none fw-bold btn" style="color: white; background-color: black; margin-top: 50px;">Please Wait a Moment...</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let showMoreButton = document.querySelector('.btn-show');
            let loadingText = document.querySelector('.loading-text');

            function showMoreProducts() {
                loadingText.classList.remove('d-none');
                showMoreButton.style.display = 'none';

                setTimeout(() => {
                    let hiddenChunks = document.querySelectorAll('.product-chunk.d-none');
                    for (let i = 0; i < 2 && i < hiddenChunks.length; i++) {
                        hiddenChunks[i].classList.remove('d-none');
                    }
                    if (hiddenChunks.length <= 2) {
                        showMoreButton.style.display = 'none';
                    } else {
                        showMoreButton.style.display = 'block';
                    }

                    loadingText.classList.add('d-none');
                }, 500);
            }

            if (showMoreButton) {
                showMoreButton.addEventListener('click', showMoreProducts);
            }
        });
    </script>
@endsection
