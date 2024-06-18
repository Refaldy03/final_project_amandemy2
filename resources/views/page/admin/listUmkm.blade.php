@extends('layout.main')
@push('styles')
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush
@section('title', 'Manage UMKM')
@section('content')
    <!-- List UMKM Section -->
    <div class="content-wrapper" style="background-image: url('{{ asset('images/background.png') }}');">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data UMKM</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('juki.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">List UMKM</li>
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
                            <a href="{{ route('page.admin.addUmkm') }}"
                                class="btn btn-md btn-primary fw-bold my-auto me-1">Tambah
                                UMKM</a>
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
                                <div class="d-flex justify-content-end my-2 me-2">
                                    <select name="kota_umkm" id="kota_umkm" class="form-select w-auto me-2">
                                        <option value="">Pilih Kota/Kab UMKM</option>
                                        <option value="Kota">Kota</option>
                                        <option value="Kabupaten">Kabupaten</option>
                                    </select>
                                </div>
                                <table class="table table-hover text-nowrap my-2" id="datatableUmkm" name="datatableUmkm">
                                    <thead class="bg-black">
                                        <tr>
                                            <th scope="col" class="text-center">No</th>
                                            <th scope="col" class="text-center">Nama Owner</th>
                                            <th scope="col" class="text-center">Nama UMKM</th>
                                            <th scope="col" class="text-center">Kab/Kota</th>
                                            <th scope="col" class="text-center">Lokasi</th>
                                            <th scope="col" class="text-center">Deskripsi</th>
                                            <th scope="col" class="text-center">No. WA</th>
                                            <th scope="col" class="text-center">Foto UMKM</th>
                                            <th scope="col" class="text-center" style="width: 150px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-light">
                                        {{-- @foreach ($umkms as $umkm)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $umkm->nama_umkm }}</td>
                                                <td class="text-center">{{ $umkm->kota_umkm }}</td>
                                                <td class="text-center">{{ $umkm->lokasi_umkm }}</td>
                                                <td class="text-center">{{ $umkm->deskripsi }}</td>
                                                <td class="text-center">{{ $umkm->kontak }}</td>
                                                <td class="text-center"><img
                                                        src="{{ asset('storage/umkm_images/' . $umkm->foto_umkm) }}"
                                                        alt="KTP Image" style="width: 50px; height: auto;"></td>
                                                <td class="d-flex">
                                                    <a href="{{ route('page.admin.editUmkm', ['id' => $umkm->id]) }}"
                                                        class="btn btn-warning btn-sm mx-1">Edit</a>
                                                    <form
                                                        action="{{ route('page.admin.deleteUmkm', ['id' => $umkm->id]) }}"
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
                table = $('#datatableUmkm');

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
                        url: '{{ route('datatableUmkm') }}',
                        type: "GET",

                        data: function(data) {
                            data.kota_umkm = $("#kota_umkm").val();
                        },
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
                            data: 'kota_umkm',
                            name: 'kota_umkm',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'lokasi_umkm',
                            name: 'lokasi_umkm',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'deskripsi',
                            name: 'deskripsi',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'kontak',
                            name: 'kontak',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'foto_umkm',
                            name: 'foto_umkm',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return '<img src="' + data +
                                    '" alt="Foto UMKM" width="50" height="50">';
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });

                $("#kota_umkm").on("change", function() {
                    table.ajax.reload();
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
