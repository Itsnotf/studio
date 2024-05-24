@extends('layouts.app')

@section('title', 'Update New Transaksi')
@section('desc', ' On this page you can Update a new Transaksi. ')

@section('content')
    <form action="{{ route('transaksi.update',$item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                                <input type="text" value="{{$item->user->name}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="product" class="col-sm-3 col-form-label">Product</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$item->product->title}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="paket" class="col-sm-3 col-form-label">Paket</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$item->paket->price}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="metode" class="col-sm-3 col-form-label">Metode</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$item->metode->wallet}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telpon" class="col-sm-3 col-form-label">Telpon</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$item->telpon}}" class="form-control" readonly>
                            </div>
                        </div>
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
                        <h4>Bukti Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <img alt="image" src="{{ asset('storage/'.$item->bukti_pembayaran) }}" class="w-100 mb-3">
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
