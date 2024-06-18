@extends('layout.main')
@push('styles')
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush
@section('title', 'Manage User')
@section('content')
    <!-- Manage User Section -->
    <div class="content-wrapper" style="background-image: url('{{ asset('images/background.png') }}');">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('juki.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">List User</li>
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
                            <a href="{{ route('page.admin.add') }}"
                                class="btn btn-md btn-primary fw-bold my-auto me-1">Tambah
                                User</a>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-center bg-dark">
                                <h3 class="card-title">List User</h3>
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
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select w-auto me-2">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="laki-laki">laki-laki</option>
                                        <option value="perempuan">perempuan</option>
                                    </select>
                                </div>
                                <table class="table table-hover text-nowrap" id="datatable" name="datatable">
                                    <thead class="bg-black">
                                        <tr>
                                            <th scope="col" class="text-center">No</th>
                                            <th scope="col" class="text-center">Nama</th>
                                            <th scope="col" class="text-center">Email</th>
                                            <th scope="col" class="text-center">Tanggal Lahir</th>
                                            <th scope="col" class="text-center">Jenis Kelamin</th>
                                            <th scope="col" class="text-center">No. WA</th>
                                            <th scope="col" class="text-center">Alamat</th>
                                            <th scope="col" class="text-center">Foto Profile</th>
                                            <th scope="col" class="text-center">KTP</th>
                                            <th scope="col" class="text-center" style="width: 150px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-light">
                                        {{-- @foreach ($users as $user)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $user->nama }}</td>
                                                <td class="text-center">{{ $user->email }}</td>
                                                <td class="text-center">{{ $user->password }}</td>
                                                <td class="text-center">{{ $user->tanggal_lahir }}</td>
                                                @if ($user->jenis_kelamin == 'laki-laki')
                                                    <td class="text-center">
                                                        <div class="rounded px-3 py-1 bg-black w-60 mx-auto">
                                                            {{ $user->jenis_kelamin }}</div>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <div class="rounded px-3 py-1 bg-pink text-white w-60 mx-auto">
                                                            {{ $user->jenis_kelamin }}</div>
                                                    </td>
                                                @endif
                                                <td class="text-center">{{ $user->no_wa }}</td>
                                                <td class="text-center">{{ $user->alamat }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ route('page.admin.edit', ['id' => $user->id]) }}"
                                                        class="btn btn-warning btn-sm mx-1">Edit</a>
                                                    <form action="{{ route('page.admin.delete', ['id' => $user->id]) }}"
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
                table = $('#datatable');

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
                        url: '{{ route('datatableUser') }}',
                        type: "GET",

                        data: function(data) {
                            data.jenis_kelamin = $("#jenis_kelamin").val();
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
                            data: 'email',
                            name: 'email',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'tanggal_lahir',
                            name: 'tanggal_lahir',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'jenis_kelamin',
                            name: 'jenis_kelamin',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'no_wa',
                            name: 'no_wa',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'alamat',
                            name: 'alamat',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'foto_profile',
                            name: 'foto_profile',
                            render: function(data, type, row) {
                                if (data) {
                                    return '<img src="' +
                                        data +
                                        '" alt="Foto Profile" width="50" height="50">';
                                } else {
                                    return 'Tidak ada foto profil';
                                }
                            },
                            orderable: false,
                            searchable: false,
                        },
                        {
                            data: 'ktp',
                            name: 'ktp',
                            render: function(data, type, row) {
                                if (data) {
                                    return '<img src="' +
                                        data +
                                        '" alt="Foto KTP" width="50" height="50">';
                                } else {
                                    return 'Tidak ada foto KTP';
                                }
                            },
                            orderable: false,
                            searchable: false,
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });

                $("#jenis_kelamin").on("change", function() {
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
