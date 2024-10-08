@extends('layout.layoutUserProfile')
@section('content')
    <head>
        <title>Profile User</title>
        <link rel="stylesheet" href="{{ asset('css/styleUserProfile.css') }}">
    </head>

    <div class="container pt-5 mt-5" style="font-family: 'Poppins', sans-serif;">
        <div class="d-flex justify-content-center" style="height: 85vh;">
            <div class="user-profile text-center" data-aos="fade-down">
                <div class="fotoProfileUser mb-4">
                    <img id="profileImage" src="{{ asset('images/ProfileDefault.webp') }}" alt="Default Profile Picture" style="width: 150px; height: 150px; border-radius: 50%;">
                </div>
                <div class="userInfo pt-5 mt-5 text-center">
                    <h1>{{ $user->name }}</h1>
                    <p>{{ $user->email }}</p>
                    <p>
                        @if ($user->phone_number)
                            {{ $user->phone_number }}
                        @else
                            <span class="fw-bold text-danger">"Tambahkan nomor handphone anda"</span>
                        @endif
                    </p>
                    <p>
                        @if ($user->address)
                            {{ $user->address }}
                        @else
                            <span class="fw-bold text-danger">"Tambahkan alamat anda"</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
