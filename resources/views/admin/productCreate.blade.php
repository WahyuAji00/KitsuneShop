@extends('layout.layoutAdmin')
@section('content')

    <div class="content-wrapper pt-4 mt-5">
        <div class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Create Product</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('adminPage.product') }}">Product</a></li>
                        <li class="breadcrumb-item active">Tambah Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('adminPage.product.prosesCreateProduct') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Tambah Product</h3>
                                </div>
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputFile">Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputFile" name="addimage" aria-describedby="inputFileAddon">
                                                    <label class="custom-file-label" for="inputFile">Choose File</label>
                                                </div>
                                            </div>
                                            @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="inputNameImage">Name Image</label>
                                            <input type="text" class="form-control" id="inputNameImage" name="nameImage" placeholder="Enter name image">
                                            @error('nameImage')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDescription">Description</label>
                                            <textarea class="form-control" id="inputDescription" name="description" placeholder="Enter description"></textarea>
                                            @error('description')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPrice">Price</label>
                                            <input type="number" class="form-control" id="inputPrice" name="price" placeholder="Enter price">
                                            @error('price')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="inputStock">Stock</label>
                                            <input type="number" class="form-control" id="inputStock" name="stock" placeholder="Enter stock">
                                            @error('stock')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="inputCategory">Category</label>
                                                <select class="form-control" id="inputCategory" name="category">
                                                    <option disabled selected>...</option>
                                                    <option value="Figma">Figma</option>
                                                    <option value="Scaled Figure">Scaled Figure</option>
                                                    <option value="Nendroid">Nendroid</option>
                                                </select>
                                            </div>
                                            @error('category')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <script>
            document.getElementById('inputFile').addEventListener('change', function() {
                var fileName = this.files[0].name;
                var label = this.nextElementSibling;
                label.textContent = fileName;
            });
        </script>
@endsection
