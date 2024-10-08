@extends('layout.layoutUser')
@section('content')
    <head>
        <title>Detail Produk</title>
        <link rel="stylesheet" href="{{ asset('css/styleDetailProduk.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    </head>
    <div class="content-container">
        <svg class="pt-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <defs>
                <filter id="waveShadow" x="0" y="0">
                    <feDropShadow dx="0" dy="10" stdDeviation="10" flood-color="rgba(0, 0, 0, 0.5)" />
                </filter>
            </defs>
            <path filter="url(#waveShadow)" fill="#ff602bdb" fill-opacity="1" d="M0,192L20,208C40,224,80,256,120,224C160,192,200,96,240,85.3C280,75,320,149,360,170.7C400,192,440,160,480,176C520,192,560,256,600,272C640,288,680,256,720,256C760,256,800,288,840,266.7C880,245,920,171,960,138.7C1000,107,1040,117,1080,112C1120,107,1160,85,1200,112C1240,139,1280,213,1320,245.3C1360,277,1400,267,1420,261.3L1440,256L1440,0L1420,0C1400,0,1360,0,1320,0C1280,0,1240,0,1200,0C1160,0,1120,0,1080,0C1040,0,1000,0,960,0C920,0,880,0,840,0C800,0,760,0,720,0C680,0,640,0,600,0C560,0,520,0,480,0C440,0,400,0,360,0C320,0,280,0,240,0C200,0,160,0,120,0C80,0,40,0,20,0L0,0Z"></path>
        </svg>
        <div class="overlay">
            <div class="text-box pb-5">
                <h1>Detail</h1>
                <p class="pt-2" style="color: white"><a class="fw-bold" href="{{ route('home') }}">Home</a h> > <a class="fw-bold" href="{{ route('shop') }}">Shop</a> > Detail</p>
            </div>
        </div>
    </div>

    <div class="container pb-4 pt-4" style="font-family: 'Poppins', sans-serif;">
        <div class="product-detail">
            <div class="product-image" data-aos="fade-right">
                <img src="{{ asset('storage/products/' . $products->image) }}" alt="{{ $products->name }}" style="width: 400px;">
            </div>
            <div class="product-info" data-aos="fade-left">
                <h1 style="color: #ff602b">{{ $products->name }}</h1>
                <hr class="my-4" style="border-bottom: 4px solid black">
                <h3 class="fw-bold">IDR {{ number_format($products->price, 2, ',', '.') }}</h3>
                <p>
                    <div class="d-flex align-items-center quantity-selector">
                        <h5 class="me-4 mb-0">Qty:</h5>
                        <input type="number" id="quantity" name="quantity" min="1" max="{{ $products->stock }}" value="1" class="form-control" style="width: 100px; box-shadow: none;">
                    </div>
                    <div class="pt-4 d-flex align-items-center">
                        <form action="{{ route('shop.addToFavorites', $products->id) }}" method="POST" class="me-2 pt-2">
                            @csrf
                            <button id="favoriteButton" type="submit" class="btn btn-favorite d-flex align-items-center {{ $products->favorites->where('user_id', Auth::id())->count() ? 'favorited' : 'not-favorited' }}">
                                <span class="me-2">
                                    <svg id="favoriteIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" style="fill: {{ $products->favorites->where('user_id', Auth::id())->count() ? '#ff0000' : '#ccc' }};">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                </span>
                                <span id="favoriteCount">{{ $products->favorites_count }}</span>
                            </button>
                        </form>
                        <form action="{{ route('shop.addToCart', $products->id) }}" method="POST" class="flex-grow-1">
                            @csrf
                            <input type="hidden" name="quantity" id="quantityInput" value="1">
                            <button class="btn w-100 fw-bold btn-addToCart" style="background-color: #ff602b">
                                <span>Add to Cart</span>
                            </button>
                        </form>
                    </div>
                </p>
                <hr class="my-4" style="border-bottom: 4px solid black">
                <div>
                    <strong>Description:</strong>
                    <p style="line-height: 1.5">@php echo nl2br(e($products->description)); @endphp</p>
                </div>
                <p><strong>Stock:</strong> {{ $products->stock }}</p>
                <p><strong>Category:</strong> {{ $products->category }}</p>
            </div>
        </div>
    </div>
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: {
                        confirmButton: 'btn btn-confirm-cart'
                    },
                    buttonsStyling: false
                });
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#favoriteButton').on('click', function(event) {
                event.preventDefault();

                const productId = "{{ $products->id }}";
                const token = "{{ csrf_token() }}";

                $.ajax({
                    url: "{{ route('shop.addToFavorites', $products->id) }}",
                    type: "POST",
                    data: {
                        _token: token,
                        product_id: productId
                    },
                    success: function(data) {
                        if (data.success) {
                            $('#favoriteCount').text(data.favorites_count);
                            $('#favoriteIcon').css('fill', data.is_favorited ? '#ff0000' : '#ccc');

                            if (data.is_favorited) {
                                $('#favoriteButton').removeClass('not-favorited').addClass('favorited');
                            } else {
                                $('#favoriteButton').removeClass('favorited').addClass('not-favorited');
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var overlay = document.getElementById('successOverlay');
            if (overlay) {
                overlay.classList.add('show');
                setTimeout(function() {
                    overlay.classList.remove('show');
                }, 3000);
            }
        });
    </script>
@endsection
