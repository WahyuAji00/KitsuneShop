@extends('layout.layoutUser')
@section('content')
    <head>
        <title>About</title>
        <link rel="stylesheet" href="{{ asset('css/styleContact.css') }}">
    </head>
    <div class="content-container">
        <svg class="pt-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <defs>
                <filter id="waveShadow" x="0" y="0">
                    <feDropShadow dx="0" dy="10" stdDeviation="10" flood-color="rgba(0, 0, 0, 0.5)" />
                </filter>
            </defs>
            <path filter="url(#waveShadow)" fill="#ff602bdb" fill-opacity="1" d="M0,224L17.1,213.3C34.3,203,69,181,103,176C137.1,171,171,181,206,170.7C240,160,274,128,309,122.7C342.9,117,377,139,411,144C445.7,149,480,139,514,149.3C548.6,160,583,192,617,202.7C651.4,213,686,203,720,202.7C754.3,203,789,213,823,224C857.1,235,891,245,926,256C960,267,994,277,1029,240C1062.9,203,1097,117,1131,90.7C1165.7,64,1200,96,1234,106.7C1268.6,117,1303,107,1337,101.3C1371.4,96,1406,96,1423,96L1440,96L1440,0L1422.9,0C1405.7,0,1371,0,1337,0C1302.9,0,1269,0,1234,0C1200,0,1166,0,1131,0C1097.1,0,1063,0,1029,0C994.3,0,960,0,926,0C891.4,0,857,0,823,0C788.6,0,754,0,720,0C685.7,0,651,0,617,0C582.9,0,549,0,514,0C480,0,446,0,411,0C377.1,0,343,0,309,0C274.3,0,240,0,206,0C171.4,0,137,0,103,0C68.6,0,34,0,17,0L0,0Z"></path>
        </svg>
        <div class="overlay">
            <div class="text-box pb-5 text-center">
                <h1>About</h1>
                <p class="pt-2" style="color: white"><a class="fw-bold" href="{{ route('home') }}">Home</a> > <a href="{{ route('about') }}">About</a></p>
            </div>
        </div>
    </div>
@endsection
