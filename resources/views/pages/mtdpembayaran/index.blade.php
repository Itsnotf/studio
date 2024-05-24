@extends('layouts.app')

@section('title', 'Manage Pakets')
@section('desc', ' On this page you can manage pakets. ')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Product List</h4>
            <div class="card-header-action">
                <a href="{{ route('metode-pembayaran.create') }}" class="btn btn-primary">
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
                            <th>Image</th>
                            <th>E-Wallet</th>
                            <th>No E-wallet</th>
                            <th>Atas Nama</th>
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
                url: "{!! url()->current() !!}"
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'ALL']
            ],
            responsive: true,
            order: [
                [0, 'desc'],
            ],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'image', name: 'image'},
                {data: 'wallet', name: 'wallet'},
                {data: 'no_wallet', name: 'no_wallet'},
                {data: 'an', name: 'an'},
            ],
            columnDefs: [{
                "targets": 1,
                "render": function(data, type, row, meta) {
                    let img = `assets/img/product/vector.jpg`;
                    if(data) {
                        img = `storage/${data}`;
                    }

                    return `<img alt="image" src="{{ asset('/') }}${img}"  width="35">`;
                }
            },{
                "targets": 3,
                "render": function(data, type, row, meta) {
                    return `
                        ${data}
                        <form action="{{ url('/metode-pembayaran') }}/${row.id}" method="POST" class="table-links">
                            @method('DELETE')
                            @csrf
                            <a
                                href="{{ url('/metode-pembayaran') }}/${row.id}/edit"
                                class="btn btn-sm"
                            >
                                Edit
                            </a>
                            <button
                                type="submit"
                                class="text-danger btn-delete btn btn-sm"
                            >
                                Delete
                            </button>
                        </form>
                    `;
                }
            }],
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
@endpush()
