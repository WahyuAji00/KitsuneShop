<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kitsune Shop</title>
    <link rel="stylesheet" href="{{ asset('css/styleLayoutUser.css') }}">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Kavoon&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const images = document.querySelectorAll('img');
            images.forEach((img) => {
                img.addEventListener('contextmenu', (e) => {
                    e.preventDefault();
                });
            });
        });
    </script>
    <style>
        #navbarNav .nav-link {
            color: black;
            border: none;
            position: relative;
            overflow: hidden;
            transition: color 0.4s;
        }

        #navbarNav .nav-link:hover {
            color: #ff602bdb;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <img src="{{ asset('images/KS.png') }}" alt="KitsuneShop" width="40" height="34" style="margin-left: 30px">
            <a class="navbar-brand kavoon-regular" style="margin-left: 5px">Kitsune Shop</a>
            <div class="collapse navbar-collapse justify-content-center poppins-semibold" id="navbarNav" style="margin-left: 300px">
                <ul class="navbar-nav fw-bold">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('shop') }}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
                <div class="iconKS" style="padding-left: 250px">
                    <a href="#"><img src="{{ asset('images/ProfileLogo.png') }}" alt="KitsuneShop" width="20" height="20" style="margin-left: 5px"></a>
                    <a href="#"><img src="{{ asset('images/SearchLogo.png') }}" alt="KitsuneShop" width="20" height="20" style="margin-left: 30px"></a>
                    <a href="#"><img src="{{ asset('images/LikeLogo.png') }}" alt="KitsuneShop" width="20" height="20" style="margin-left: 30px"></a>
                    <a href="#"><img src="{{ asset('images/ShopLogo.png') }}" alt="KitsuneShop" width="20" height="20" style="margin-left: 30px; margin-right: 30px"></a>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn" style="background-color: #ff602bdb; color: white;">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="pt-5 mt-3" style="font-family: 'Poppins', sans-serif;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 pe-5">
                    <h3 class="fw-bold"><strong>Kitsune Shop</strong></h3>
                    <p>400 University Drive Suite 200 Coral Gables, FL 33134 USA</p>
                </div>
                <div class="col-md-4 ps-3">
                    <h4>Links</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Help</h4>
                    <ul>
                        <li><a href="#">Payment Options</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Privacy Policies</a></li>
                    </ul>
                    <h4 class="pt-5 pb-4">Newsletter</h4>
                    <form>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Enter Your Email Address" required>
                        </div>
                        <button type="submit" class="btn btn-send" style="background-color: white"><span>SEND</span></button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pt-5">
                <p class="text-center">&copy; 2023 Kitsune Shop All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.querySelector('.overlay');
            overlay.classList.add('visible');

            let lastScrollTop = 0;
            window.addEventListener('scroll', () => {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > lastScrollTop) {
                    if (scrollTop > window.innerHeight / 10) {
                        overlay.classList.remove('visible');
                    }
                } else {
                    if (scrollTop < window.innerHeight / 10) {
                        overlay.classList.add('visible');
                    }
                }
                lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
            });
        });
    </script>
</body>
</html>
