@extends('layouts.app')

@section('title', 'Create New Metode Pembayaran')
@section('desc', ' On this page you can create a new Metode Pembayaran. ')

@section('content')
    <form action="{{ route('metode-pembayaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Metode Pembayaran Form</h4>
                    </div>
                    <div class="card-body">
                        <input type="file" class="d-none" id="image" name="image">

                        <div class="form-group row">
                            <label for="wallet" class="col-sm-3 col-form-label">Wallet</label>
                            <div class="col-sm-9">
                                <input value="{{ old('wallet') }}" type="text"
                                    class="form-control @error('wallet') is-invalid @enderror" name="wallet" id="wallet"
                                    placeholder="Wallet">
                                @error('wallet')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_wallet" class="col-sm-3 col-form-label">No Wallet</label>
                            <div class="col-sm-9">
                                <input value="{{ old('no_wallet') }}" type="number"
                                    class="form-control @error('no_wallet') is-invalid @enderror" name="no_wallet" id="no_wallet"
                                    placeholder="No Wallet">
                                @error('no_wallet')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="an" class="col-sm-3 col-form-label">Atas Nama</label>
                            <div class="col-sm-9">
                                <input value="{{ old('an') }}" type="text"
                                    class="form-control @error('an') is-invalid @enderror" name="an" id="an"
                                    placeholder="Atas Nama">
                                @error('an')
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
