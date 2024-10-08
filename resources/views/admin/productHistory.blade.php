@extends('layout.layoutAdmin')
@section('content')

<div class="content-wrapper pt-4 mt-5">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Product History</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('adminPage.product') }}">Product</a></li>
                        <li class="breadcrumb-item active">Product History</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Products</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $index => $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($product->image)
                                                <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100px; height: 100px;">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>@php echo nl2br(e($product->description)); @endphp</td>
                                        <td>IDR {{ $product->price }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->category }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('adminPage.product.restoreProduct', ['id' => $product->id]) }}" class="btn btn-warning" style="margin-right: 10px;"><i class="fas fa-undo"></i></a>
                                            <a class="btn btn-danger" data-toggle="modal" data-target="#modal-forceDeleteProduct{{ $product->id }}"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-forceDeleteProduct{{ $product->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><b>Confirmation Edit Product</b></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you <b>Delete Product Data?</b> </p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <a href="{{ route('adminPage.product.forceDeleteProduct', ['id' => $product->id]) }}"><button type="submit" class="btn btn-primary">Delete Permanent</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
