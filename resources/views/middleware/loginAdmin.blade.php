@extends('layout.layoutSessionAdmin')
@section('content')
<head>
    <title>Login Admin</title>
</head>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form method="POST" action="{{ route('loginAdmin') }}" class="form-group">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
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
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                            <div class="d-flex justify-content-center login">
                                <button type="submit" class="btn fw-bold btn-show" style="background-color: #ff602bdb"><span>Login</span></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <span>Don't have an account? </span><a href="{{ route('registerAdmin') }}" style="text-decoration: none; color: rgb(4, 0, 255);">Register here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
