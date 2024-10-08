@extends('layout.layoutSessionAdmin')
@section('content')
<head>
    <title>Register Admin</title>
</head>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Register</h2>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form method="POST" action="{{ route('registerAdmin') }}" class="form-group">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input class="requiredUser-Admin-SuperAdmin" type="text" class="form-control" placeholder="Enter Your Name" id="username" name="username" required>
                                @error('username')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input class="requiredUser-Admin-SuperAdmin" type="email" class="form-control" placeholder="Enter Your Email Address" id="email" name="email" required>
                                @error('email')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input class="requiredUser-Admin-SuperAdmin" type="password" class="form-control" placeholder="Enter Your Password" id="password" name="password" required>
                                @error('password')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input class="requiredUser-Admin-SuperAdmin" type="password" class="form-control" placeholder="Enter Your Confirmation Password" id="password_confirmation" name="password_confirmation" required>
                                @error('password_confimation')
                                    <small>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-center register">
                                <button type="submit" class="btn fw-bold btn-show" style="background-color: #ff602bdb"><span>Register</span></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <span>Already have an account? </span><a href="{{ route('loginAdmin') }}" style="text-decoration: none; color: rgb(4, 0, 255);">Login here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
