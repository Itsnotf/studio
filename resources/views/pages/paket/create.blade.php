@extends('layouts.app')

@section('title', 'Create New Paket')
@section('desc', ' On this page you can create a new paket. ')

@section('content')
    <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Paket Form</h4>
                    </div>
                    <div class="card-body">
                        <input type="file" class="d-none" id="image" name="image">
                        <div class="form-group row">
                            <label for="product" class="col-sm-3 col-form-label">Product</label>
                            <div class="col-sm-9">
                                <select class="custom-select" name="product_id"  @error('product') is-invalid @enderror id="inputGroupSelect01">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->title }}</option>
                                    @endforeach
                                </select>
                                @error('product')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input value="{{ old('price') }}" type="number"
                                    class="form-control @error('price') is-invalid @enderror" name="price" id="price"
                                    placeholder="Price">
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="desc" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc"
                                    placeholder="Description">{{ old('desc') }}</textarea>
                                @error('desc')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="note" class="col-sm-3 col-form-label">Note</label>
                            <div class="col-sm-9">
                                <input value="{{ old('note') }}" type="text"
                                    class="form-control @error('note') is-invalid @enderror" name="note" id="note"
                                    placeholder="Note">
                                @error('note')
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
