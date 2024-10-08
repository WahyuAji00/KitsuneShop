@extends('layout.layoutAdmin')
@section('content')

    <style>
        .content {
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            font-style: normal;
        }
    </style>

    <div class="content-wrapper pt-4 mt-5">
        <div class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Dashboard</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><ion-icon name="people"></ion-icon></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Data User</span>
                            <span class="info-box-number">{{ $userCount }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><ion-icon name="person" style="color: white"></ion-icon></ion-icon></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Admin</span>
                            <span class="info-box-number">{{ $adminCount }}</span>
                        </div>
                    </div>
                </div>

                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><ion-icon class="nav-icon" name="list"></ion-icon></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Product Data</span>
                            <span class="info-box-number">{{ $productCount }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Sales</span>
                            <span class="info-box-number">{{ $saleCount }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
