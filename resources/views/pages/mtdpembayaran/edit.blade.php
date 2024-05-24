@extends('layouts.app')

@section('title', 'Edit Metode Pembayaran')
@section('desc', ' On this page you can edit a Metode Pembayaran. ')

@section('content')
    <form action="{{ route('metode-pembayaran.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Metode Pembayaran Form</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="wallet" class="col-sm-3 col-form-label">Wallet</label>
                            <div class="col-sm-9">
                                <input value="{{ old('wallet', $item->wallet) }}" type="text"
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
                                <input value="{{ old('no_wallet', $item->no_wallet) }}" type="text"
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
                                <input value="{{ old('an', $item->an) }}" type="text"
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
