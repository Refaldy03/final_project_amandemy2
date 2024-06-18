@extends('layout.app')
@push('styles')
    <style>
        .form-label {
            font-weight: bold;
        }
    </style>
@endpush
@section('title', 'Edit Loker')
@section('content')
    <!-- Edit Loker Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="py-2" style="background-color: rgba(0, 0, 0, 0.7);">
                    <div class="grid mx-5 mt-4 mb-2">
                        <div class="row row-gap-3">
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
                                <div class="card mx-5">
                                    <div class="card-body rounded px-4" style="background-color: rgba(70, 130, 180)">
                                        <h1 class="h2 mb-5 fw-bold">Data Lowongan Pekerjaan</h1>
                                        <form method="POST" action="{{ route('loker.update', $loker->id) }}">
                                            @method('PUT')
                                            @csrf
                                            <div class="row mb-2">
                                                <div class="col-sm-5">
                                                    <div class="form-group mb-2">
                                                        <label class="form-label col-sm-5" for="posisi_loker">Posisi Loker
                                                            :</label style="font-size: 14px">
                                                        <input type="text"
                                                            class="form-control @error('posisi_loker') is-invalid @enderror"
                                                            id="posisi_loker" name="posisi_loker"
                                                            value="{{ old('posisi_loker') ? old('posisi_loker') : $loker->posisi_loker }}"
                                                            placeholder="Masukkan Posisi Loker">
                                                        @error('posisi_loker')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="jumlah_loker" class="form-label">Jumlah Loker :</label>
                                                        <input type="number"
                                                            class="form-control @error('jumlah_loker') is-invalid @enderror"
                                                            id="jumlah_loker" name="jumlah_loker"
                                                            value="{{ old('jumlah_loker') ? old('jumlah_loker') : $loker->jumlah_loker }}"
                                                            placeholder="Masukkan Jumlah Loker">
                                                        @error('jumlah_loker')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-5 offset-md-2">
                                                    <div class="mb-2">
                                                        <div class="mb-2">
                                                            <label for="kualifikasi" class="form-label">Kualifikasi
                                                                Loker
                                                                :</label>
                                                            <textarea class="form-control @error('kualifikasi') is-invalid @enderror" id="kualifikasi" name="kualifikasi"
                                                                rows="4" placeholder="Masukkan Kualifikasi Loker">{{ old('kualifikasi', $loker->kualifikasi) }}</textarea>
                                                            @error('kualifikasi')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 my-2 text-center">
                                                    <button type="submit" id="updateBtn"
                                                        class="btn btn-success border border-black border-2 mt-2">Update</button>
                                                    <a href="{{ route('loker') }}"
                                                        class="btn btn-dark border border-black border-2  mt-2">Kembali</a>
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
