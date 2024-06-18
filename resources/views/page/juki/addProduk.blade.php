@extends('layout.app')
@push('styles')
    <style>
        .form-label {
            font-weight: bold;
        }
    </style>
@endpush

@section('title', 'Add Produk')
@section('content')
    <!-- Add Produk Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12">
                <a class="btn btn-dark mb-4 fw-bold border-3 border-primary" href="{{ route('produk') }}"><svg class="me-2"
                        viewBox="0 0 24 24" aria-hidden="true" fill="currentColor" weight="20px" height="20px">
                        <g>
                            <path d="M7.414 13l5.043 5.04-1.414 1.42L3.586 12l7.457-7.46 1.414 1.42L7.414 11H21v2H7.414z">
                            </path>
                        </g>
                    </svg>Back</a>
                <div class="py-2" style="background-color: rgba(0, 0, 0, 0.7);">
                    <div class="row mx-5 my-4">
                        <div class="col-md-8 offset-2">

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

                            <div class="card ms-4">
                                <div class="card-body rounded px-4" style="background-color: rgba(70, 130, 180)">
                                    <h1 class="h2 mb-4 fw-bold">Tambah Produk</h1>
                                    <form class="mt-3" action="{{ route('produk.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-1">
                                            <label for="foto_produk" class="form-label fw-semibold">Foto Produk</label>
                                            <input type="file"
                                                class="form-control @error('foto_produk') is-invalid @enderror"
                                                name="foto_produk" id="foto_produk" placeholder="Masukkan gambar produk"
                                                value="{{ old('foto_produk') }}">
                                            @error('foto_produk')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-1">
                                            <label for="nama_produk" class="form-label fw-semibold">Nama Produk</label>
                                            <input type="text"
                                                class="form-control @error('nama_produk') is-invalid @enderror"
                                                name="nama_produk" id="nama_produk" placeholder="Masukkan Nama Produk"
                                                value="{{ old('nama_produk') }}">
                                            @error('nama_produk')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-1">
                                            <label for="Harga" class="form-label fw-semibold">Harga</label>
                                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                                name="harga" id="harga" placeholder="Masukkan Harga produk"
                                                value="{{ old('harga') }}">
                                            @error('harga')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="d-flex">
                                            <div class="mx-auto mt-4 mb-2">
                                                <a href="{{ route('produk') }}"
                                                    class="btn btn-warning me-2 border-2 border-white">
                                                    Kembali</a>
                                                <button class="btn btn-dark border-2 border-white"
                                                    type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
