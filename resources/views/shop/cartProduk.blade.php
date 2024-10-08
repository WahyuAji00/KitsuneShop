@extends('layout.layoutUser')
@section('content')
    <head>
        <title>Cart Produk</title>
        <link rel="stylesheet" href="{{ asset('css/styleCart.css') }}">
    </head>

    <div class="content-container">
        <svg class="pt-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <defs>
                <filter id="waveShadow" x="0" y="0">
                    <feDropShadow dx="0" dy="10" stdDeviation="10" flood-color="rgba(0, 0, 0, 0.5)" />
                </filter>
            </defs>
            <path filter="url(#waveShadow)" fill="#ff602b" fill-opacity="1" d="M0,288L18.5,250.7C36.9,213,74,139,111,122.7C147.7,107,185,149,222,186.7C258.5,224,295,256,332,261.3C369.2,267,406,245,443,224C480,203,517,181,554,192C590.8,203,628,245,665,261.3C701.5,277,738,267,775,261.3C812.3,256,849,256,886,213.3C923.1,171,960,85,997,96C1033.8,107,1071,213,1108,240C1144.6,267,1182,213,1218,176C1255.4,139,1292,117,1329,133.3C1366.2,149,1403,203,1422,229.3L1440,256L1440,0L1421.5,0C1403.1,0,1366,0,1329,0C1292.3,0,1255,0,1218,0C1181.5,0,1145,0,1108,0C1070.8,0,1034,0,997,0C960,0,923,0,886,0C849.2,0,812,0,775,0C738.5,0,702,0,665,0C627.7,0,591,0,554,0C516.9,0,480,0,443,0C406.2,0,369,0,332,0C295.4,0,258,0,222,0C184.6,0,148,0,111,0C73.8,0,37,0,18,0L0,0Z"></path>
        </svg>
        <div class="overlay">
            <div class="text-box pb-5">
                <h1>Cart</h1>
                <p class="pt-2" style="color: white"><a class="fw-bold" href="{{ route('home') }}">Home</a> > <a class="fw-bold" href="{{ route('shop') }}">Shop</a> > Cart</p>
            </div>
        </div>
    </div>

    <div class="contentCart pb-3" style="font-family: 'Poppins', sans-serif;">
        <div class="cart-products">
            <h2 class="fw-bold text-center pt-5" data-aos="fade-up">My Cart</h2>
            <div class="pt-3 pb-5 mt-4 rounded-3 products-container d-flex align-items-center justify-content-center" style="box-shadow: 0 8px 12px rgba(0, 0, 0, 0.586); width: 90%; margin: 0 auto; background-color: #ff602b; min-height: 300px;" data-aos="zoom-in-up">
                @if ($cartProducts->isEmpty())
                    <p class="text-center fw-bold text-white m-0" style="font-size: 20px;">🫥 You have no cart products 🫥</p>
                @else
                    <div class="w-50">
                        @php
                            $chunks = $cartProducts->chunk(1)
                        @endphp

                        @foreach ($chunks as $chunkIndex => $cartproductChunk)
                            <div class="line d-flex justify-content-center pt-4 gap-4 {{ $chunkIndex >= 3 ? 'd-none product-chunk' : '' }}">
                                @foreach ($cartproductChunk as $product)
                                    <div class="d-flex rounded-3" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.284); width: 100%; height: auto;">
                                        <a href="{{ route('shop.detailProduct', ['name' => $product->name]) }}" style="margin: 0 auto;">
                                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" style="border-top-left-radius: 10px;" width="100%" height="auto">
                                        </a>
                                        <div class="px-2 w-100 d-flex flex-column justify-content-between" style="background-color: #F4F5F7; border-bottom-right-radius: 10px; height: 100%;">
                                            <div>
                                                <a href="{{ route('shop.detailProduct', ['name' => $product->name]) }}" style="text-decoration: none; color: black;">
                                                    <h6 class="fw-bold pt-3 product-name" style="font-size: 22px">{{ $product->name }}</h6>
                                                </a>
                                                <h6 style="color: #ff602b; font-size: 18px;">IDR {{ number_format($product->price, 0, ',', '.') }}</h6>
                                            </div>
                                            <div class="d-flex align-items-center quantity-selector">
                                                <h5 class="me-4 mb-0">Qty:</h5>
                                                <input type="number" id="quantity" name="quantity" min="1" max="{{ $product->stock }}" value="{{ $product->quantity }}" class="form-control" style="width: 100px; box-shadow: none;">
                                            </div>
                                            <div class="pb-4">
                                                <form action="{{ route('shop.addToCart', $product->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="quantity" id="quantityInput" value="1">
                                                    <button class="btn w-100 fw-bold btn-buyNow" style="background-color: #000000;">
                                                        <span>Buy Now</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        @if ($chunks->count() > 3)
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
                    for (let i = 0; i < 3 && i < hiddenChunks.length; i++) {
                        hiddenChunks[i].classList.remove('d-none');
                    }
                    if (hiddenChunks.length <= 3) {
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
