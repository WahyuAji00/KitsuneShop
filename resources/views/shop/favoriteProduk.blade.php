@extends('layout.layoutUser')
@section('content')
    <head>
        <title>Favorit Produk</title>
        <link rel="stylesheet" href="{{ asset('css/styleFavoriteProduct.css') }}">
    </head>

    <div class="content-container">
        <svg class="pt-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <defs>
                <filter id="waveShadow" x="0" y="0">
                    <feDropShadow dx="0" dy="10" stdDeviation="10" flood-color="rgba(0, 0, 0, 0.5)" />
                </filter>
            </defs>
            <path filter="url(#waveShadow)" fill="#ff602b" fill-opacity="1" d="M0,256L18.5,234.7C36.9,213,74,171,111,128C147.7,85,185,43,222,37.3C258.5,32,295,64,332,106.7C369.2,149,406,203,443,218.7C480,235,517,213,554,208C590.8,203,628,213,665,224C701.5,235,738,245,775,229.3C812.3,213,849,171,886,176C923.1,181,960,235,997,261.3C1033.8,288,1071,288,1108,272C1144.6,256,1182,224,1218,186.7C1255.4,149,1292,107,1329,96C1366.2,85,1403,107,1422,117.3L1440,128L1440,0L1421.5,0C1403.1,0,1366,0,1329,0C1292.3,0,1255,0,1218,0C1181.5,0,1145,0,1108,0C1070.8,0,1034,0,997,0C960,0,923,0,886,0C849.2,0,812,0,775,0C738.5,0,702,0,665,0C627.7,0,591,0,554,0C516.9,0,480,0,443,0C406.2,0,369,0,332,0C295.4,0,258,0,222,0C184.6,0,148,0,111,0C73.8,0,37,0,18,0L0,0Z"></path>
        </svg>
        <div class="overlay">
            <div class="text-box pb-5">
                <h1>Favorite</h1>
                <p class="pt-2" style="color: white"><a class="fw-bold" href="{{ route('home') }}">Home</a> > <a class="fw-bold" href="{{ route('shop') }}">Shop</a> > Favorite</p>
            </div>
        </div>
    </div>

    <div class="contentFavorite pb-3" style="font-family: 'Poppins', sans-serif;">
        <div class="favorite-products">
            <h2 class="fw-bold text-center pt-5" data-aos="fade-up">My Favorite</h2>
            <div class="pt-3 pb-5 mt-4 rounded-3 products-container d-flex align-items-center justify-content-center" style="box-shadow: 0 8px 12px rgba(0, 0, 0, 0.586); width: 90%; margin: 0 auto; background-color: #ff602b; min-height: 300px;" data-aos="zoom-in-up">
                @if ($favoriteProducts->isEmpty())
                    <p class="text-center fw-bold text-white m-0" style="font-size: 20px;">🫥 You have no favorite products 🫥</p>
                @else
                    <div class="w-100">
                        @php
                            $chunks = $favoriteProducts->chunk(4);
                        @endphp

                        @foreach ($chunks as $chunkIndex => $favoriteproductChunk)
                            <div class="line d-flex justify-content-center pt-4 gap-4 {{ $chunkIndex >= 2 ? 'd-none product-chunk' : '' }}">
                                @foreach ($favoriteproductChunk as $product)
                                    <div class="d-flex flex-column rounded-3" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.284); width: 18%; height: auto;">
                                        <a href="{{ route('shop.detailProduct', ['name' => $product->name]) }}" style="margin: 0 auto;">
                                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-top" width="100%" height="auto">
                                        </a>
                                        <div class="px-2 rounded-bottom" style="background-color: #F4F5F7;">
                                            <a href="{{ route('shop.detailProduct', ['name' => $product->name]) }}" style="text-decoration: none; color: black;">
                                                <h6 class="fw-bold pt-3 product-name">{{ $product->name }}</h6>
                                            </a>
                                            <h6 style="color: #ff602b; font-size: 14px;">IDR {{ number_format($product->price, 0, ',', '.') }}</h6>
                                            <form action="{{ route('shop.addToCart', $product->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="quantity" id="quantityInput" value="1">
                                                <button class="btn w-100 fw-bold btn-addToCart" style="background-color: #000000">
                                                    <span>Add to Cart</span>
                                                </button>
                                            </form>
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
