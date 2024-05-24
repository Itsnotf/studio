@extends('layouts.app')

@section('title', 'Edit Product')
@section('desc', ' On this page you can edit a product. ')

@section('content')
    <form action="{{ route('product.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Product Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input value="{{ old('title', $item->title) }}" type="text"
                                    class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                                    placeholder="">
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
                                <input value="{{ old('desc', $item->desc) }}" type="text"
                                    class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc"
                                    placeholder="">
                                @error('desc')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Avatar</h4>
                    </div>
                    <div class="card-body">
                        @if ($item->image)
                            <img alt="image" src="{{ asset('storage') }}/{{ $item->image }}"
                                class=" w-100 mb-3">
                        @else
                            <img alt="image" src="{{ asset('/assets/img/product/vector.jpg') }}"
                                class=" w-100 mb-3">
                        @endif
                        <div class="clearfix"></div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="avatar" name="avatar">
                            <label class="custom-file-label" for="avatar">Choose Avatar</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
