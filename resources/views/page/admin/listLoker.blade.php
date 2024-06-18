@extends('layout.main')
@push('styles')
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush
@section('title', 'Manage Loker')
@section('content')
    <!-- Manage Loker Section -->
    <div class="content-wrapper" style="background-image: url('{{ asset('images/background.png') }}');">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Loker</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('juki.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">List Loker</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content py-4">
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end mb-2">
                            <a href="{{ route('page.admin.addLoker') }}"
                                class="btn btn-md btn-primary fw-bold my-auto me-1">Tambah
                                Loker</a>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-center bg-dark">
                                <h3 class="card-title">List UMKM</h3>
                            </div>
                            <div class="mx-4 px-4">
                                @if (Session::get('success'))
                                    <div class="alert alert-success mt-3">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif

                                @if (Session::get('error'))
                                    <div class="alert alert-danger mt-3">
                                        {{ Session::get('error') }}
                                    </div>
                                @endif
                            </div>

                            <div class="card-body table-responsive p-2" style="background-color: rgba(70, 130, 180)">
                                <table class="table table-hover text-nowrap my-2" id="datatableLoker" name="datatableLoker">
                                    <thead class="bg-black">
                                        <tr>
                                            <th scope="col" class="text-center">No</th>
                                            <th scope="col" class="text-center">Nama Owner</th>
                                            <th scope="col" class="text-center">Nama UMKM</th>
                                            <th scope="col" class="text-center">Posisi Loker</th>
                                            <th scope="col" class="text-center">Jumlah Loker</th>
                                            <th scope="col" class="text-center">Kualifikasi Loker</th>
                                            <th scope="col" class="text-center" style="width: 150px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-light">
                                        {{-- @foreach ($lokers as $loker)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $loker->posisi_loker }}</td>
                                                <td class="text-center">{{ $loker->jumlah_loker }}</td>
                                                <td class="text-center">{{ $loker->kualifikasi }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ route('page.admin.editLoker', ['id' => $loker->id]) }}"
                                                        class="btn btn-warning btn-sm mx-1">Edit</a>
                                                    <form
                                                        action="{{ route('page.admin.deleteLoker', ['id' => $loker->id]) }}"
                                                        method="POST" class="ms-1">
                                                        @csrf()
                                                        <button class="btn btn-sm btn-danger" type="submit"
                                                            type="submit">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
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
                table = $('#datatableLoker');

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
                        url: '{{ route('datatableLoker') }}',
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
                            data: 'nama',
                            name: 'nama',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'nama_umkm',
                            name: 'nama_umkm',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'posisi_loker',
                            name: 'posisi_loker',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'jumlah_loker',
                            name: 'jumlah_loker',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'kualifikasi',
                            name: 'kualifikasi',
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
    </script>
@endpush
