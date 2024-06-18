@extends('layout.main')
@section('title', 'Edit Umkm')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('juki.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Data Umkm</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content py-4" style="background-image: url('{{ asset('images/background.png') }}');">
            <div class="container-fluid px-5 mb-3">
                @if (Session::get('error'))
                    <div class="row">
                        <div class="col-md-4 offset-4 mt-2 py-2 rounded bg-danger text-white fw-bold">
                            {{ Session::get('error') }}
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6 offset-3 rounded bg-dark mt-3 p-4">
                        <h2 class="text-center fw-bold" style="font-size: 25px">Edit Data User {{ $umkm->id }}</h2>
                        <form class="mt-3" action="{{ route('page.admin.updateUmkm', ['id' => $umkm->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="mb-1">
                                <label for="nama_umkm" class="form-label">Nama UMKM
                                    :</label>
                                <input type="text" class="form-control @error('nama_umkm') is-invalid @enderror"
                                    id="nama_umkm" name="nama_umkm"
                                    value="{{ old('nama_umkm') ? old('nama_umkm') : $umkm->nama_umkm }}"
                                    placeholder="Masukkan Nama UMKM Anda">
                                @error('nama_umkm')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label class="form-label col-sm-4" for="kota_umkm">Kab/Kota :
                                </label style="font-size: 14px">
                                <select id="kota_umkm" name="kota_umkm"
                                    class="form-control @error('kota_umkm') is-invalid @enderror">
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
                            <div class="mb-1">
                                <label for="lokasi_umkm" class="form-label">Lokasi
                                    :</label>
                                <input type="text" class="form-control @error('lokasi_umkm') is-invalid @enderror"
                                    id="lokasi_umkm" name="lokasi_umkm"
                                    value="{{ old('lokasi_umkm') ? old('lokasi_umkm') : $umkm->lokasi_umkm }}"
                                    placeholder="Masukkan Lokasi Maps">
                                @error('lokasi_umkm')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="kontak" class="form-label">No. WhatsApp
                                    :</label>
                                <input type="number" class="form-control @error('kontak') is-invalid @enderror"
                                    id="kontak" name="kontak"
                                    value="{{ old('kontak') ? old('kontak') : $umkm->kontak }}"
                                    placeholder="Masukkan Nomor">
                                @error('kontak')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="deskripsi" class="form-label">Deskripsi
                                    :</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                    rows="2" placeholder="Masukkan Deskripsi UMKM">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="foto_umkm" class="form-label">Select a
                                    file (foto lokasi UMKM*):</label>
                                <input type="file" class="form-control @error('foto_umkm') is-invalid @enderror"
                                    id="foto_umkm" name="foto_umkm"
                                    value="{{ old('foto_umkm') ? old('foto_umkm') : $umkm->foto_umkm }}">
                                @error('foto_umkm')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex">
                                <div class="mx-auto mt-2">
                                    <a href="{{ route('page.admin.listUmkm') }}" class="btn btn-warning me-2">
                                        Kembali</a>
                                    <button class="btn btn-info mx-auto" type="submit">Update</button>
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
