@extends('layouts.app')

@section('title', 'Create New Product')
@section('desc', ' On this page you can create a new product. ')

@section('content')
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Product Form</h4>
                    </div>
                        <div class="card-body">
                            <input type="file" class="d-none" id="image" name="image">
                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label">Title</label>
                                <div class="col-sm-9">
                                    <input value="{{ old('title') }}" type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="desc" class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <input value="{{ old('desc') }}" type="text" class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" placeholder="Description">
                                    @error('desc')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Image</h4>
                    </div>
                    <div class="card-body">
                        <img alt="image" src="{{ asset('/assets/img/product/vector.jpg') }}" class="w-100 mb-3">
                        <div class="clearfix"></div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose Image</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
