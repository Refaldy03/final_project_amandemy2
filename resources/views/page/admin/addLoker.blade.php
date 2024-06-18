@extends('layout.main')
@section('title', 'Add Loker')
@section('content')
    <!-- Add Loker Section -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 fw-bold">Tambah Data Loker</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('juki.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Data User</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content py-4" style="background-image: url('{{ asset('images/background.png') }}');">
            <div class="container-fluid px-4 mb-3">
                @if (Session::get('error'))
                    <div class="row">
                        <div class="col-md-4 offset-4 mt-2 py-2 rounded bg-danger text-white fw-bold">
                            {{ Session::get('error') }}
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-3 rounded bg-dark mt-3 py-3 px-4">
                        <h2 class="text-center fw-bold" style="font-size: 25px">Tambah Data Loker</h2>
                        <form class="mt-3" action="{{ route('page.admin.storeLoker') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-1">
                                <label class="form-label col-sm-5" for="posisi_loker">Posisi Loker
                                    :</label style="font-size: 14px">
                                <input type="text" class="form-control @error('posisi_loker') is-invalid @enderror"
                                    id="posisi_loker" name="posisi_loker" placeholder="Masukkan Posisi Loker"
                                    value="{{ old('posisi_loker') }}">
                                @error('posisi_loker')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="jumlah_loker" class="form-label">Jumlah Loker :</label>
                                <input type="number" class="form-control @error('jumlah_loker') is-invalid @enderror"
                                    id="jumlah_loker" name="jumlah_loker" placeholder="Masukkan Jumlah Loker"
                                    value="{{ old('jumlah_loker') }}">
                                @error('jumlah_loker')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="kualifikasi" class="form-label">Kualifikasi
                                    Loker
                                    :</label>
                                <textarea class="form-control @error('kualifikasi') is-invalid @enderror" id="kualifikasi" name="kualifikasi"
                                    rows="4" placeholder="Masukkan Kualifikasi Loker">{{ old('kualifikasi') }}</textarea>
                                @error('kualifikasi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex">
                                <div class="mx-auto">
                                    <a href="{{ route('page.admin.index') }}"
                                        class="btn btn-warning me-2 border-3 border-primary">
                                        Kembali</a>
                                    <button class="btn btn-info" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
