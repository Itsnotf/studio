@extends('layouts.app')

@section('title', 'Create New Transaksi')
@section('desc', ' On this page you can create a new Transaksi. ')

@section('content')
    <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Transaksi Form</h4>
                    </div>
                    <div class="card-body">
                        {{-- <input type="file" class="d-none" id="image" name="image"> --}}
                        <div class="form-group row">
                            <label for="product" class="col-sm-3 col-form-label">Product</label>
                            <div class="col-sm-9">
                                <select class="custom-select" name="product_id" @error('product_id') is-invalid @enderror
                                    id="product_id">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->title }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="paket" class="col-sm-3 col-form-label">Paket</label>
                            <div class="col-sm-9">
                                <select class="custom-select" name="paket_id" @error('paket') is-invalid @enderror
                                    id="inputGroupSelect01">
                                    @foreach ($pakets as $paket)
                                        <option value="{{ $paket->id }}" data-product-id="{{ $paket->product_id }}">
                                            {{ $paket->price }}</option>
                                    @endforeach
                                </select>

                                @error('paket')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mtd_pembayaran_id" class="col-sm-3 col-form-label">Metode Pembayaran</label>
                            <div class="col-sm-9">
                                <select class="custom-select" name="mtd_pembayaran_id"
                                    @error('mtd_pembayaran_id') is-invalid @enderror id="mtd_pembayaran_id">
                                    @foreach ($mtds as $mtd)
                                        <option value="{{ $mtd->id }}">{{ $mtd->wallet }}</option>
                                    @endforeach
                                </select>
                                @error('mtd_pembayaran_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telpon" class="col-sm-3 col-form-label">No Handphone</label>
                            <div class="col-sm-9">
                                <input value="{{ old('telpon') }}" type="text"
                                    class="form-control @error('telpon') is-invalid @enderror" name="telpon" id="telpon"
                                    placeholder="No Handphone">
                                @error('telpon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
{{--
                        <div class="form-group row">
                            <label for="status" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="custom-select" name="status" @error('status') is-invalid @enderror
                                    id="status">
                                    <option value="menunggu pembayaran">Menunggu Pembayaran</option>
                                    <option value="sedang diproses">Sedang Diproses</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div> --}}
                    </div>



                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Bukti Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <img alt="image" src="{{ asset('/assets/img/product/vector.jpg') }}" class="w-100 mb-3">
                        <div class="clearfix"></div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="bukti_pembayaran" name="bukti_pembayaran">
                            <label class="custom-file-label" for="bukti_pembayaran">Choose Image</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productSelect = document.getElementById('product_id');
            const paketSelect = document.querySelector('select[name="paket_id"]');

            // Initial options of the paket select
            const initialOptions = Array.from(paketSelect.options);

            // Function to update the options of the paket select based on the selected product
            function updatePaketOptions() {
                const selectedProductId = productSelect.value;

                // Filter options to match the selected product id
                const filteredOptions = initialOptions.filter(option => {
                    return option.getAttribute('data-product-id') === selectedProductId;
                });

                // Clear existing options
                paketSelect.innerHTML = '';

                // Append filtered options to the paket select
                filteredOptions.forEach(option => {
                    paketSelect.appendChild(option.cloneNode(true));
                });
            }


            // Event listener for the product select change
            productSelect.addEventListener('change', updatePaketOptions);

            // Initial update based on the pre-selected product
            updatePaketOptions();
        });
    </script>


@endsection
