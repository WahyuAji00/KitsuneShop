@extends('layout.layoutAdmin')
@section('content')

    <style>
        .content {
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            font-style: normal;
        }

        .text-wrap {
            word-wrap: break-word;
            overflow: hidden;
        }

        .text-break {
            word-break: break-word;
        }
    </style>

    <div class="content-wrapper pt-4 mt-5">
        <div class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Data User</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('adminPage.userData.createUser') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i></a>
                    @php
                        $firstItem = true;
                    @endphp
                    @foreach ($data as $dataUser)
                        @if ($firstItem)
                        <a href="{{ route('adminPage.userData.historyUser', ['id' => $dataUser->id]) }}" class="btn btn-success mb-3"><i class="fas fa-history"></i></a>
                        @php
                            $firstItem = false;
                        @endphp
                        @endif
                    @endforeach
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">User</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                                </button>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-wrap">Nama</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dataUser)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-break" style="max-width: 150px">{{ $dataUser->name }}</td>
                                        <td class="text-break" style="max-width: 250px">{{ $dataUser->email }}</td>
                                        <td>
                                            <a href="{{ route('adminPage.userData.editUser', ['id' => $dataUser->id]) }}" class="btn btn-primary" style="margin-right: 10px"><i class="fas fa-pen"></i></a>
                                            <a href="{{ route('adminPage.userData.deleteUser', ['id' => $dataUser->id]) }}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
