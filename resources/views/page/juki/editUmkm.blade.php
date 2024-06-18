@extends('layout.app')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .form-label {
            font-weight: bold;
        }
    </style>
@endpush

@section('title', 'Edit UMKM')
@section('content')
    <!-- Edit UMKM Section -->
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
                                        <h1 class="h2 mb-4 fw-bold">Data UMKM</h1>
                                        <form method="POST" action="{{ route('umkm.update', $umkm->id) }}" id="umkmForm"
                                            enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="row mb-2">
                                                <div class="col-sm-6">
                                                    <div class="mb-2">
                                                        <label for="nama_umkm" class="form-label">Nama UMKM
                                                            :</label>
                                                        <input type="text"
                                                            class="form-control @error('nama_umkm') is-invalid @enderror"
                                                            id="nama_umkm" name="nama_umkm"
                                                            value="{{ old('nama_umkm') ? old('nama_umkm') : $umkm->nama_umkm }}"
                                                            placeholder="Masukkan Nama UMKM Anda">
                                                        @error('nama_umkm')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="form-label col-sm-4" for="kota_umkm">Kab/Kota :
                                                        </label style="font-size: 14px">
                                                        <select id="kota_umkm" name="kota_umkm"
                                                            class="form-control @error('kota_umkm') is-invalid @enderror">
                                                            <option value="" selected>Pilih Kab/Kota UMKM ---</option>
                                                            <optgroup label="Kota">
                                                                <option value="Kota Magelang"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kota Magelang' ? 'Selected' : '' }}>
                                                                    Kota Magelang</option>
                                                                <option value="Kota Semarang"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kota Semarang' ? 'Selected' : '' }}>
                                                                    Kota Semarang</option>
                                                                <option value="Kota Pekalongan"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kota Pekalongan' ? 'Selected' : '' }}>
                                                                    Kota Pekalongan</option>
                                                                <option value="Kota Tegal"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kota Tegal' ? 'Selected' : '' }}>
                                                                    Kota Tegal</option>
                                                                <option value="Kota Salatiga"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kota Salatiga' ? 'Selected' : '' }}>
                                                                    Kota Salatiga</option>
                                                                <option value="Kota Surakarta"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kota Surakarta' ? 'Selected' : '' }}>
                                                                    Kota Surakarta (Solo)</option>
                                                            </optgroup>
                                                            <optgroup label="Kabupaten">
                                                                <option value="Kabupaten Banyumas"
                                                                    {{ $umkm->condition == 'Kabupaten Banyumas' ? 'Selected' : '' }}>
                                                                    Kabupaten Banyumas
                                                                </option>
                                                                <option value="Kabupaten Cilacap"
                                                                    {{ $umkm->condition == 'Kabupaten Cilacap' ? 'Selected' : '' }}>
                                                                    Kabupaten Cilacap</option>
                                                                <option value="Kabupaten Purworejo"
                                                                    {{ $umkm->condition == 'Kabupaten Purworejo' ? 'Selected' : '' }}>
                                                                    Kabupaten Purworejo
                                                                </option>
                                                                <option value="Kabupaten Wonosobo"
                                                                    {{ $umkm->condition == 'Kabupaten Wonosobo' ? 'Selected' : '' }}>
                                                                    Kabupaten Wonosobo
                                                                </option>
                                                                <option value="Kabupaten Kebumen"
                                                                    {{ $umkm->condition == 'Kabupaten Kebumen' ? 'Selected' : '' }}>
                                                                    Kabupaten Kebumen</option>
                                                                <option value="Kabupaten Purwokerto"
                                                                    {{ $umkm->condition == 'Kabupaten Purwokerto' ? 'Selected' : '' }}>
                                                                    Kabupaten Purwokerto
                                                                </option>
                                                                <option value="Kabupaten Batang"
                                                                    {{ $umkm->condition == 'Kabupaten Batang' ? 'Selected' : '' }}>
                                                                    Kabupaten Batang</option>
                                                                <option value="Kabupaten Pekalongan"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Pekalongan' ? 'Selected' : '' }}>
                                                                    Kabupaten Pekalongan</option>
                                                                <option value="Kabupaten Pemalang"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Pemalang' ? 'Selected' : '' }}>
                                                                    Kabupaten Pemalang</option>
                                                                <option value="Kabupaten Brebes"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Brebes' ? 'Selected' : '' }}>
                                                                    Kabupaten Brebes</option>
                                                                <option value="Kabupaten Jepara"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Jepara' ? 'Selected' : '' }}>
                                                                    Kabupaten Jepara</option>
                                                                <option value="Kabupaten Kudus"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Kudus' ? 'Selected' : '' }}>
                                                                    Kabupaten Kudus</option>
                                                                <option value="Kabupaten Pati"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Pati' ? 'Selected' : '' }}>
                                                                    Kabupaten Pati</option>
                                                                <option value="Kabupaten Rembang"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Rembang' ? 'Selected' : '' }}>
                                                                    Kabupaten Rembang</option>
                                                                <option value="Kabupaten Blora"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Blora' ? 'Selected' : '' }}>
                                                                    Kabupaten Blora</option>
                                                                <option value="Kabupaten Kendal"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Kendal' ? 'Selected' : '' }}>
                                                                    Kabupaten Kendal</option>
                                                                <option value="Kabupaten Temanggung"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Temanggung' ? 'Selected' : '' }}>
                                                                    Kabupaten Temanggung</option>
                                                                <option value="Kabupaten Semarang"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Semarang' ? 'Selected' : '' }}>
                                                                    Kabupaten Semarang</option>
                                                                <option value="Kabupaten Demak"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Demak' ? 'Selected' : '' }}>
                                                                    Kabupaten Demak</option>
                                                                <option value="Kabupaten Grobogan"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Grobogan' ? 'Selected' : '' }}>
                                                                    Kabupaten Grobogan</option>
                                                                <option value="Kabupaten Klaten"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Klaten' ? 'Selected' : '' }}>
                                                                    Kabupaten Klaten</option>
                                                                <option value="Kabupaten Magelang"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Magelang' ? 'Selected' : '' }}>
                                                                    Kabupaten Magelang</option>
                                                                <option value="Kabupaten Boyolali"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Boyolali' ? 'Selected' : '' }}>
                                                                    Kabupaten Boyolali
                                                                </option>
                                                                <option value="Kabupaten Sragen"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Sragen<' ? 'Selected' : '' }}>
                                                                    Kabupaten Sragen</option>
                                                                <option value="Kabupaten Wonogiri"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Wonogiri<' ? 'Selected' : '' }}>
                                                                    Kabupaten Sragen</option>
                                                                <option value="Kabupaten Karanganyar"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Karanganyar<' ? 'Selected' : '' }}>
                                                                    Kabupaten Sragen</option>
                                                                <option value="Kabupaten Sukoharjo"
                                                                    {{ old('kota_umkm', $umkm->kota_umkm) == 'Kabupaten Sukoharjo<' ? 'Selected' : '' }}>
                                                                    Kabupaten Sragen</option>
                                                            </optgroup>
                                                        </select>
                                                        @error('kota_umkm')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="lokasi_umkm" class="form-label">Lokasi
                                                            :</label>
                                                        <input type="text"
                                                            class="form-control @error('lokasi_umkm') is-invalid @enderror"
                                                            id="lokasi_umkm" name="lokasi_umkm"
                                                            value="{{ old('lokasi_umkm') ? old('lokasi_umkm') : $umkm->lokasi_umkm }}"
                                                            placeholder="Masukkan Lokasi Maps">
                                                        @error('lokasi_umkm')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-2">
                                                        <div class="mb-2">
                                                            <label for="deskripsi" class="form-label">Deskripsi
                                                                :</label>
                                                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                                                rows="2" placeholder="Masukkan Deskripsi UMKM">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                                                            @error('deskripsi')
                                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="kontak" class="form-label">No. WhatsApp
                                                            :</label>
                                                        <input type="number"
                                                            class="form-control @error('kontak') is-invalid @enderror"
                                                            id="kontak" name="kontak"
                                                            value="{{ old('kontak') ? old('kontak') : $umkm->kontak }}"
                                                            placeholder="Masukkan Nomor">
                                                        @error('kontak')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="foto_umkm" class="form-label">Select a
                                                            file (foto lokasi UMKM*):</label>
                                                        <input type="file"
                                                            class="form-control @error('foto_umkm') is-invalid @enderror"
                                                            id="foto_umkm" name="foto_umkm"
                                                            value="{{ old('foto_umkm') ? old('foto_umkm') : $umkm->foto_umkm }}">
                                                        @error('foto_umkm')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 my-2 text-center">
                                                    <button type="submit" id="updateBtn"
                                                        class="btn btn-success border border-black border-2  mt-2">Update</button>
                                                    <a href="{{ route('dashboard') }}"
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
