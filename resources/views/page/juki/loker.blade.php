@extends('layout.app')
@push('styles')
    <style>
        .form-label {
            font-weight: bold;
        }
    </style>
@endpush
@section('title', 'Loker')
@section('content')
    <!-- Loker Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12">
                <a class="btn btn-dark border-3 border-primary mb-4 fw-bold" href="{{ url()->previous() }}"><svg class="me-2"
                        viewBox="0 0 24 24" aria-hidden="true" fill="currentColor" weight="20px" height="20px">
                        <g>
                            <path d="M7.414 13l5.043 5.04-1.414 1.42L3.586 12l7.457-7.46 1.414 1.42L7.414 11H21v2H7.414z">
                            </path>
                        </g>
                    </svg>Back</a>
                <div class="py-3" style="background-color: rgba(0, 0, 0, 0.7);">
                    <div class="grid mx-5 mt-4 mb-2">
                        <div class="row row-gap-3">
                            @if (isset($umkm) && isset($loker))
                                <div class="col-sm-6 col-md-4 col-lg-3 my-5">
                                    <a href="{{ route('detailLoker', $loker->id) }}" class="text-decoration-none">
                                        <div class="card w-100 mt-3" style="background-color: rgb(243, 198, 240)">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between my-auto" style="font-size: 18px">
                                                    <p class="card-title text-dark fw-bold my-auto">{{ $umkm->nama_umkm }}
                                                    </p>
                                                </div>
                                                <div class="d-flex justify-content-between my-2">
                                                    <div class="text-start">
                                                        <p class="my-auto rounded bg-dark text-white py-1 px-2 fw-semibold"
                                                            style="font-size: 14px">{{ $umkm->kota_umkm }}
                                                        </p>
                                                    </div>
                                                    <div class="text-end">
                                                        <a href="{{ $umkm->lokasi_umkm }}"
                                                            class="my-auto rounded py-1 bg-success px-2 fw-bold text-dark text-decoration-none"
                                                            style="font-size: 14px">
                                                            <svg width="17" height="17" fill="red"
                                                                class="bi bi-geo-alt-fill mb-1" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                                            </svg>
                                                            <svg viewBox="0 0 24 24" aria-hidden="true" fill="black"
                                                                weight="20px" height="20px">
                                                                <g>
                                                                    <path
                                                                        d="M21.591 7.146L12.52 1.157c-.316-.21-.724-.21-1.04 0l-9.071 5.99c-.26.173-.409.456-.409.757v13.183c0 .502.418.913.929.913H9.14c.51 0 .929-.41.929-.913v-7.075h3.909v7.075c0 .502.417.913.928.913h6.165c.511 0 .929-.41.929-.913V7.904c0-.301-.158-.584-.408-.758z">
                                                                    </path>
                                                                </g>
                                                            </svg></a>
                                                    </div>
                                                </div>
                                                <p class="fw-bold"
                                                    style="font-size: 14px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; margin: 10px auto;">
                                                    {{ $loker->jumlah_loker }} Posisi {{ $loker->posisi_loker }}
                                                </p>
                                                <p
                                                    style="font-size: 14px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; margin: 10px auto;">
                                                    {{ $loker->kualifikasi }}
                                                </p>
                                                <div>
                                                    <a href="mailto:{{ $umkm->user->email }}"
                                                        class="w-100 my-auto rounded py-1 btn btn-warning btn-block px-2 fw-bold text-primary text-decoration-none"
                                                        style="font-size: 14px">Kirim Email <svg class="mb-1"
                                                            weight="17px" height="17px" fill="#007bff"
                                                            class="bi bi-envelope" viewBox="0 0 16 16">
                                                            <path
                                                                d="M0 4.516V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.516l-8 5.333-8-5.333zm1-1L8 9.849 15 3V2H1v1.516z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="d-flex justify-content-center mt-2">
                                        <a href="{{ route('loker.edit', ['id' => $umkm->id]) }}"
                                            class="btn btn-success border border-black border-2 mt-2 me-2">Edit <svg
                                                width="16" height="16" fill="currentColor"
                                                class="bi bi-pen-fill mb-1" viewBox="0 0 16 16">
                                                <path
                                                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001" />
                                            </svg></a>
                                        <form action="{{ route('loker.destroy', ['id' => $loker->id]) }}" method="POST">
                                            @csrf()
                                            <button class="btn btn-danger border border-black border-2 mt-2 ms-2"
                                                type="submit">Delete <svg width="19" height="19" fill="currentColor"
                                                    class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div>
                                    <p
                                        class="mb-3 ms-4 py-2 px-4 trounded alert alert-danger alert-dismissible fade show text-center fw-semibold">
                                        Tidak ada data Loker UMKM yang dimasukkan {{ Auth::user()->email }}.</p>
                                </div>
                            @endif
                            <div class="col mb-3">
                                <div class="ms-4">
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
                                </div>
                                <div class="card ms-4">
                                    <div class="card-body rounded px-4 border" style="background-color: rgba(70, 130, 180)">
                                        <h1 class="h2 mb-5 fw-bold border border-3 p-2 text-center"
                                            style="background-color: rgb(110, 101, 190)">Data Lowongan Pekerjaan <svg
                                                width="40" height="40" fill="dark" class="bi bi-briefcase-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5" />
                                                <path
                                                    d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85z" />
                                            </svg>
                                        </h1>
                                        <form method="POST" action="{{ route('loker.store') }}">
                                            @csrf
                                            <div class="row mb-2">
                                                <div class="col-sm-6">
                                                    <div class="form-group mb-2">
                                                        <label class="form-label col-sm-5" for="posisi_loker">Posisi Loker
                                                            :</label style="font-size: 14px">
                                                        <input type="text"
                                                            class="form-control @error('posisi_loker') is-invalid @enderror"
                                                            id="posisi_loker" name="posisi_loker"
                                                            placeholder="Masukkan Posisi Loker"
                                                            value="{{ old('posisi_loker') }}">
                                                        @error('posisi_loker')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="jumlah_loker" class="form-label">Jumlah Loker
                                                            :</label>
                                                        <input type="number"
                                                            class="form-control @error('jumlah_loker') is-invalid @enderror"
                                                            id="jumlah_loker" name="jumlah_loker"
                                                            placeholder="Masukkan Jumlah Loker"
                                                            value="{{ old('jumlah_loker') }}">
                                                        @error('jumlah_loker')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-2">
                                                        <div class="mb-2">
                                                            <label for="kualifikasi" class="form-label">Kualifikasi
                                                                Loker
                                                                :</label>
                                                            <textarea class="form-control @error('kualifikasi') is-invalid @enderror" id="kualifikasi" name="kualifikasi"
                                                                rows="4" placeholder="Masukkan Kualifikasi Loker">{{ old('kualifikasi') }}</textarea>
                                                            @error('kualifikasi')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 my-2 text-center">
                                                    <button type="submit"
                                                        class="btn btn-primary border border-black border-2 mt-2">Create
                                                        <svg width="16" height="16" fill="currentColor"
                                                            class="bi bi-plus mb-1" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 7V1a1 1 0 1 1 2 0v6h6a1 1 0 1 1 0 2H10v6a1 1 0 1 1-2 0V9H2a1 1 0 1 1 0-2h6z" />
                                                        </svg></button>
                                                    <button type="reset"
                                                        class="btn btn-dark border border-black border-2 mt-2"><i
                                                            class="bi bi-bootstrap-reboot"></i> Reset
                                                        Data</button>
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
    </div>
@endsection
