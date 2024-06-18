@extends('layout.app')
@push('styles')
    <style>
        .form-label {
            font-weight: bold;
        }
    </style>
@endpush

@section('title', 'Produk')
@section('content')
    <!-- Produk Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12">
                <a class="btn btn-dark border-3 border-primary mb-4 fw-bold" href="{{ route('dashboard') }}"><svg
                        class="me-2" viewBox="0 0 24 24" aria-hidden="true" fill="currentColor" weight="20px" height="20px">
                        <g>
                            <path d="M7.414 13l5.043 5.04-1.414 1.42L3.586 12l7.457-7.46 1.414 1.42L7.414 11H21v2H7.414z">
                            </path>
                        </g>
                    </svg>Back</a>
                <a href="{{ route('produk.add') }}"
                    class="btn btn-md btn-success border-3 border-primary fw-bold mx-4 mb-4"><svg width="16"
                        height="16" fill="currentColor" class="bi bi-plus mb-1" viewBox="0 0 16 16">
                        <path d="M8 7V1a1 1 0 1 1 2 0v6h6a1 1 0 1 1 0 2H10v6a1 1 0 1 1-2 0V9H2a1 1 0 1 1 0-2h6z" />
                    </svg> Tambah Produk</a>
                <div class="py-2" style="background-color: rgba(0, 0, 0, 0.7);">
                    <div class="grid mx-5 mt-4 mb-2">
                        <div class="row">
                            <div class="col mb-3">

                                <!-- error message -->
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <!-- success message -->
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="card">
                                    <div class="card-body rounded px-4" style="background-color: rgba(70, 130, 180)">
                                        <h1 class="h2 mb-4 fw-bold text-center">List Produk <svg width="40"
                                                height="40" fill="red" class="bi bi-bag-fill mb-3"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z" />
                                            </svg></h1>
                                        <table class="table table-hover text-nowrap my-2" id="datatableProduk"
                                            name="datatableProduk">
                                            <thead style="background-color: rgb(209, 88, 233)">
                                                <tr>
                                                    <th scope="col" class="text-center">No</th>
                                                    <th scope="col" class="text-center">Nama Produk</th>
                                                    <th scope="col" class="text-center">Harga</th>
                                                    <th scope="col" class="text-center">Foto Produk</th>
                                                    <th scope="col" class="text-center" style="width: 150px">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-white text-center" style="background-color: black">
                                                {{-- @foreach ($produks as $produk)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">{{ $produk->nama_produk }}</td>
                                                        <td class="text-center">{{ $produk->harga }}</td>
                                                        <td class="text-center"><img
                                                                src="{{ asset('storage/produk_images/' . $produk->foto_produk) }}"
                                                                alt="Produk Image" style="width: 30px; height: 30px;"></td>
                                                        <td class="d-flex justifty-content-center">
                                                            <a href="{{ route('produk.edit', ['id' => $produk->id]) }}"
                                                                class="btn btn-warning btn-sm mx-1"><i
                                                                    class="bi bi-pen"></i> Edit</a>
                                                            <form
                                                                action="{{ route('produk.destroy', ['id' => $produk->id]) }}"
                                                                method="POST" class="ms-1">
                                                                @csrf()
                                                                <button class="btn btn-sm btn-danger" type="submit"
                                                                    type="submit"><i class="bi bi-trash"></i>
                                                                    Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            KTDatatablesDataSourceAjaxServer.init();
        })
        var table;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })
        $.fn.dataTable.ext.errMode = 'none';

        var KTDatatablesDataSourceAjaxServer = function() {
            var initTable1 = function() {
                table = $('#datatableProduk');

                table = table.DataTable({
                    paging: true,
                    responsive: true,
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    language: {
                        paginate: {
                            next: "Next",
                            previous: "Previous"
                        },
                        "sSearch": "Cari",
                        "sLengthMenu": "Show <select>" +
                            "<option value='5'>5</option>" +
                            "<option value='10'>10</option>" +
                            "<option value='50'>50</option>" +
                            "<option value='100'>100</option>" +
                            "<option value='200'>200</option>" +
                            "<option value='500'>500</option>" +
                            "</select> entries"
                    },
                    ajax: {
                        url: '{{ route('datatableProduk') }}',
                        type: "GET",
                    },
                    lengthMenu: [5, 10, 50, 100, 200, 500],
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama_produk',
                            name: 'nama_produk',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'harga',
                            name: 'harga',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'foto_produk',
                            name: 'foto_produk',
                            render: function(data, type, row) {
                                return '<img src="/storage/produk_images/' + data +
                                    '" alt="Foto Produk" width="50" height="50">';
                            },
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });

                table.on('draw', function() {});
            };

            return {
                init: function() {
                    initTable1();
                },
            };
        }();

        // Fungsi untuk menutup notifikasi secara manual
        function closeNotification() {
            document.querySelector('.alert').style.display = 'none';
        }
    </script>
@endpush
