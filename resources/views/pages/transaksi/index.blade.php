@extends('layouts.app')

@section('title', 'Manage Transaksi')
@section('desc', ' On this page you can manage Transaksi. ')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Transaksi List</h4>
            <div class="card-header-action">
                <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    Add New
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pembeli</th>
                            <th>Product</th>
                            <th>Paket</th>
                            <th>Pembayaran</th>
                            <th>Bukti Pembayaran</th>
                            <th>Telepon</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            var datatable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: "{{ route('transaksi.index') }}", // perbaikan URL
                    type: "GET"
                },
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'ALL']
                ],
                responsive: true,
                order: [
                    [0, 'desc'],
                ],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user',
                        name: 'user',
                        render: function(data) {
                            return data;
                        }
                    },
                    {
                        data: 'product',
                        name: 'product',
                        render: function(data) {
                            return data;
                        }
                    },
                    {
                        data: 'paket',
                        name: 'paket',
                        render: function(data) {
                            return data;
                        }
                    },
                    {
                        data: 'metode',
                        name: 'metode',
                        render: function(data) {
                            return data;
                        }
                    },
                    {
                        data: 'bukti_pembayaran',
                        name: 'bukti_pembayaran'
                    },
                    {
                        data: 'telpon',
                        name: 'telpon'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    }
                ],
                columnDefs: [{
                        "targets": 5,
                        "render": function(data, type, row, meta) {
                            let img = `assets/img/product/vector.jpg`;
                            if (data) {
                                img = `storage/${data}`;
                            }
                            return `<img alt="image" src="{{ asset('/') }}${img}" width="35">`;
                        }
                    },
                    {
                        "targets": 6,
                        "render": function(data, type, row, meta) {
                            return `
                            ${data}
                            <form action="{{ url('/transaksi') }}/${row.id}" method="POST" class="table-links">
                                @method('DELETE')
                                @csrf
                                <a href="{{ url('/transaksi') }}/${row.id}/edit" class="btn btn-sm">Edit</a>
                                <button type="submit" class="text-danger btn-delete btn btn-sm">Delete</button>
                            </form>`;
                        }
                    }
                ],
                rowId: function(a) {
                    return a;
                },
                rowCallback: function(row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    $('td:eq(0)', row).html(index);
                },
            });
        });
    </script>
@endpush
