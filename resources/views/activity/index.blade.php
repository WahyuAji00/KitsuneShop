@extends('layout.layoutUser')
@section('content')
    <head>
        <title>Activity</title>
        <link rel="stylesheet" href="{{ asset('css/styleAbout.css') }}">
    </head>
    <div class="content-container">
        <svg class="pt-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <defs>
                <filter id="waveShadow" x="0" y="0">
                    <feDropShadow dx="0" dy="10" stdDeviation="10" flood-color="rgba(0, 0, 0, 0.5)" />
                </filter>
            </defs>
            <path filter="url(#waveShadow)" fill="#ff602bdb" fill-opacity="1" d="M0,192L17.1,176C34.3,160,69,128,103,106.7C137.1,85,171,75,206,85.3C240,96,274,128,309,160C342.9,192,377,224,411,224C445.7,224,480,192,514,197.3C548.6,203,583,245,617,266.7C651.4,288,686,288,720,282.7C754.3,277,789,267,823,261.3C857.1,256,891,256,926,218.7C960,181,994,107,1029,117.3C1062.9,128,1097,224,1131,261.3C1165.7,299,1200,277,1234,224C1268.6,171,1303,85,1337,74.7C1371.4,64,1406,128,1423,160L1440,192L1440,0L1422.9,0C1405.7,0,1371,0,1337,0C1302.9,0,1269,0,1234,0C1200,0,1166,0,1131,0C1097.1,0,1063,0,1029,0C994.3,0,960,0,926,0C891.4,0,857,0,823,0C788.6,0,754,0,720,0C685.7,0,651,0,617,0C582.9,0,549,0,514,0C480,0,446,0,411,0C377.1,0,343,0,309,0C274.3,0,240,0,206,0C171.4,0,137,0,103,0C68.6,0,34,0,17,0L0,0Z"></path>
        </svg>
        <div class="overlay">
            <div class="text-box pb-5 text-center">
                <h1>Activity</h1>
                <p class="pt-2" style="color: white"><a class="fw-bold" href="{{ route('home') }}">Home</a> > <a href="{{ route('activity') }}">Activity</a></p>
            </div>
        </div>
    </div>
@endsection
