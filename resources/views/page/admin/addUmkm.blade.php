@extends('layout.main')
@section('title', 'Tambah UMKM')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 fw-bold">Tambah Data Umkm</h1>
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
                        <h2 class="text-center fw-bold" style="font-size: 25px">Tambah Data User</h2>
                        <form class="mt-3" action="{{ route('page.admin.storeUmkm') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-1">
                                <label for="nama_umkm" class="form-label">Nama UMKM
                                    :</label>
                                <input type="text" class="form-control @error('nama_umkm') is-invalid @enderror"
                                    id="nama_umkm" name="nama_umkm" placeholder="Masukkan Nama UMKM Anda"
                                    value="{{ old('nama_umkm') }}">
                                @error('nama_umkm')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label class="form-label col-sm-4" for="kota_umkm">Kab/Kota :
                                </label style="font-size: 14px">
                                <select id="kota_umkm" name="kota_umkm"
                                    class="form-control @error('kota_umkm') is-invalid @enderror">
                                    <option value="0" {{ old('kota_umkm') == '0' ? 'selected' : '' }}>Pilih
                                        Kab/Kota
                                        UMKM ---
                                    </option>
                                    <optgroup label="Kota">
                                        <option value="Kota Magelang"
                                            {{ old('kota_umkm') == 'Kota Magelang' ? 'selected' : '' }}>
                                            Kota Magelang</option>
                                        <option value="Kota Semarang"
                                            {{ old('kota_umkm') == 'Kota Semarang' ? 'selected' : '' }}>
                                            Kota Semarang</option>
                                        <option value="Kota Pekalongan"
                                            {{ old('kota_umkm') == 'Kota Pekalongan' ? 'selected' : '' }}>
                                            Kota Pekalongan</option>
                                        <option value="Kota Tegal"
                                            {{ old('kota_umkm') == 'Kota Tegal' ? 'selected' : '' }}>
                                            Kota Tegal</option>
                                        <option value="Kota Salatiga"
                                            {{ old('kota_umkm') == 'Kota Salatiga' ? 'selected' : '' }}>
                                            Kota Salatiga</option>
                                        <option value="Kota Surakarta"
                                            {{ old('kota_umkm') == 'Kota Surakarta' ? 'selected' : '' }}>
                                            Kota Surakarta (Solo)
                                        </option>
                                    </optgroup>
                                    <optgroup label="Kabupaten">
                                        <option value="Kabupaten Banyumas"
                                            {{ old('kota_umkm') == 'Kabupaten Banyumas' ? 'selected' : '' }}>
                                            Kabupaten Banyumas
                                        </option>
                                        <option value="Kabupaten Cilacap"
                                            {{ old('kota_umkm') == 'Kabupaten Cilacap' ? 'selected' : '' }}>
                                            Kabupaten Cilacap</option>
                                        <option value="Kabupaten Purworejo"
                                            {{ old('kota_umkm') == 'Kabupaten Purworejo' ? 'selected' : '' }}>
                                            Kabupaten Purworejo
                                        </option>
                                        <option value="Kabupaten Wonosobo"
                                            {{ old('kota_umkm') == 'Kabupaten Wonosobo' ? 'selected' : '' }}>
                                            Kabupaten Wonosobo
                                        </option>
                                        <option value="Kabupaten Kebumen"
                                            {{ old('kota_umkm') == 'Kabupaten Kebumen' ? 'selected' : '' }}>
                                            Kabupaten Kebumen</option>
                                        <option value="Kabupaten Purwokerto"
                                            {{ old('kota_umkm') == 'Kabupaten Purwokerto' ? 'selected' : '' }}>
                                            Kabupaten Purwokerto
                                        </option>
                                        <option value="Kabupaten Batang"
                                            {{ old('kota_umkm') == 'Kabupaten Batang' ? 'selected' : '' }}>
                                            Kabupaten Batang</option>
                                        <option value="Kabupaten Pekalongan"
                                            {{ old('kota_umkm') == 'Kabupaten Pekalongan' ? 'selected' : '' }}>
                                            Kabupaten Pekalongan
                                        </option>
                                        <option value="Kabupaten Pemalang"
                                            {{ old('kota_umkm') == 'Kabupaten Pemalang' ? 'selected' : '' }}>
                                            Kabupaten Pemalang
                                        </option>
                                        <option value="Kabupaten Brebes"
                                            {{ old('kota_umkm') == 'Kabupaten Brebes' ? 'selected' : '' }}>
                                            Kabupaten Brebes</option>
                                        <option value="Kabupaten Jepara"
                                            {{ old('kota_umkm') == 'Kabupaten Jepara' ? 'selected' : '' }}>
                                            Kabupaten Jepara</option>
                                        <option value="Kabupaten Kudus"
                                            {{ old('kota_umkm') == 'Kabupaten Kudus' ? 'selected' : '' }}>
                                            Kabupaten Kudus</option>
                                        <option value="Kabupaten Pati"
                                            {{ old('kota_umkm') == 'Kabupaten Pati' ? 'selected' : '' }}>
                                            Kabupaten Pati</option>
                                        <option value="Kabupaten Rembang"
                                            {{ old('kota_umkm') == 'Kabupaten Rembang' ? 'selected' : '' }}>
                                            Kabupaten Rembang</option>
                                        <option value="Kabupaten Blora"
                                            {{ old('kota_umkm') == 'Kabupaten Blora' ? 'selected' : '' }}>
                                            Kabupaten Blora</option>
                                        <option value="Kabupaten Kendal"
                                            {{ old('kota_umkm') == 'Kabupaten Kendal' ? 'selected' : '' }}>
                                            Kabupaten Kendal</option>
                                        <option value="Kabupaten Temanggung"
                                            {{ old('kota_umkm') == 'Kabupaten Temanggung' ? 'selected' : '' }}>
                                            Kabupaten Temanggung
                                        </option>
                                        <option value="Kabupaten Semarang"
                                            {{ old('kota_umkm') == 'Kabupaten Semarang' ? 'selected' : '' }}>
                                            Kabupaten Semarang
                                        </option>
                                        <option value="Kabupaten Demak"
                                            {{ old('kota_umkm') == 'Kabupaten Demak' ? 'selected' : '' }}>
                                            Kabupaten Demak</option>
                                        <option value="Kabupaten Grobogan"
                                            {{ old('kota_umkm') == 'Kabupaten Grobogan' ? 'selected' : '' }}>
                                            Kabupaten Grobogan</option>
                                        <option value="Kabupaten Klaten"
                                            {{ old('kota_umkm') == 'Kabupaten Klaten' ? 'selected' : '' }}>
                                            Kabupaten Klaten</option>
                                        <option value="Kabupaten Magelang"
                                            {{ old('kota_umkm') == 'Kabupaten Magelang' ? 'selected' : '' }}>
                                            Kabupaten Magelang
                                        </option>
                                        <option value="Kabupaten Boyolali"
                                            {{ old('kota_umkm') == 'Kabupaten Boyolali' ? 'selected' : '' }}>
                                            Kabupaten Boyolali
                                        </option>
                                        <option value="Kabupaten Sragen"
                                            {{ old('kota_umkm') == 'Kabupaten Sragen' ? 'selected' : '' }}>
                                            Kabupaten Sragen</option>
                                        <option value="Kabupaten Wonogiri"
                                            {{ old('kota_umkm') == 'Kabupaten Wonogiri' ? 'selected' : '' }}>
                                            Kabupaten Wonogiri
                                        </option>
                                        <option value="Kabupaten Karanganyar"
                                            {{ old('kota_umkm') == 'Kabupaten Karanganyar' ? 'selected' : '' }}>
                                            Kabupaten Karanganyar
                                        </option>
                                        <option value="Kabupaten Sukoharjo"
                                            {{ old('kota_umkm') == 'Kabupaten Sukoharjo' ? 'selected' : '' }}>
                                            Kabupaten Sukoharjo
                                        </option>
                                    </optgroup>
                                </select>
                                @error('kota_umkm')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="lokasi_umkm" class="form-label">Lokasi
                                    :</label>
                                <input type="text" class="form-control @error('lokasi_umkm') is-invalid @enderror"
                                    id="lokasi_umkm" name="lokasi_umkm" placeholder="Masukkan Lokasi Maps"
                                    value="{{ old('lokasi_umkm') }}">
                                @error('lokasi_umkm')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1 mt-3">
                                <label for="kontak" class="form-label">No. WhatsApp
                                    :</label>
                                <input type="number" class="form-control @error('kontak') is-invalid @enderror"
                                    id="kontak" name="kontak" placeholder="Masukkan Nomor WhatsApp UMKM"
                                    value="{{ old('kontak') }}">
                                @error('kontak')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="deskripsi" class="form-label">Deskripsi
                                    :</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                    rows="2" placeholder="Masukkan Deskripsi UMKM">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="foto_umkm" class="form-label">Select a
                                    file (foto lokasi UMKM*):</label>
                                <input type="file" class="form-control @error('foto_umkm') is-invalid @enderror"
                                    id="foto_umkm" name="foto_umkm">
                                @error('foto_umkm')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex">
                                <div class="mx-auto">
                                    <a href="{{ route('page.admin.dashboard') }}" class="btn btn-warning me-2">
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
