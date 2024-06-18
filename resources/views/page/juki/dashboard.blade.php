@extends('layout.app')
@push('styles')
    <style>
        .form-label {
            font-weight: bold;
        }
    </style>
@endpush

@section('title', 'Dashboard')
@section('content')
    <!-- Dashboard Section -->
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
                <a class="btn btn-success border-3 border-primary mx-4 mb-4 fw-bold" href="{{ route('produk') }}"><svg
                        width="24" height="24" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                        <path
                            d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                        <path
                            d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.371l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                    </svg> Manage Produk</a>
                <div class="py-3" style="background-color: rgba(0, 0, 0, 0.7);">
                    <div class="grid mx-5 mt-4 mb-2">
                        <div class="row row-gap-3">
                            @if (isset($umkm))
                                <div class="col-sm-6 col-md-4 col-lg-3 my-5">
                                    <div class="card w-100" style="background-color: rgb(243, 198, 240)">
                                        <a href="{{ route('detailUmkm', $umkm->id) }}" class="text-decoration-none">
                                            <img class="card-img-top rounded img-fluid"
                                                style="object-fit: cover; height: 150px;"
                                                src="{{ asset('storage/umkm_images/' . $umkm->foto_umkm) }}"
                                                alt="{{ $umkm->nama_umkm }}">
                                        </a>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between my-auto" style="font-size: 18px">
                                                <p class="card-title fw-bold my-auto">{{ $umkm->nama_umkm }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between flex-wrap mt-2">
                                                <div class="text-start mb-2 mb-md-1">
                                                    <p class="my-auto rounded bg-dark text-white py-1 px-2 fw-semibold"
                                                        style="font-size: 14px">{{ $umkm->kota_umkm }}
                                                    </p>
                                                </div>
                                                <div class="text-end">
                                                    <a href="{{ $umkm->lokasi_umkm }}"
                                                        class="my-auto rounded py-1 bg-success px-2 fw-bold text-dark text-decoration-none"
                                                        style="font-size: 14px"><svg width="17" height="17"
                                                            fill="red" class="bi bi-geo-alt-fill mb-1"
                                                            viewBox="0 0 16 16">
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
                                            <p
                                                style="font-size: 14px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; margin: 10px auto;">
                                                {{ $umkm->deskripsi }}</p>
                                            <a href="https://wa.me/{{ $umkm->kontak }}"
                                                class="btn btn-primary btn-sm w-100 fw-bold mt-auto">
                                                Hubungi Kontak
                                                <svg class="bg-success rounded-circle mb-1" width="20" height="20"
                                                    fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                                    <path
                                                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-2">
                                        @if ($umkm)
                                            <a href="{{ route('umkm.edit', ['id' => $umkm->id]) }}"
                                                class="btn btn-success border border-black border-2 mt-2 me-2">Edit <svg
                                                    width="16" height="16" fill="currentColor"
                                                    class="bi bi-pen-fill mb-1" viewBox="0 0 16 16">
                                                    <path
                                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('umkm.destroy', ['id' => $umkm->id]) }}" method="POST">
                                                @csrf()
                                                <button class="btn btn-danger border border-black border-2 mt-2 ms-2"
                                                    type="submit">Delete <svg width="19" height="19"
                                                        fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div>
                                    <p
                                        class="mb-3 ms-4 py-2 px-4 trounded alert alert-danger alert-dismissible fade show text-center fw-semibold">
                                        Tidak
                                        ada data UMKM yang dimasukkan {{ Auth::user()->email }}.</p>
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
                                        <h1 class="h2 mb-4 fw-bold border border-3 p-2 text-center"
                                            style="background-color: rgb(110, 101, 190)">Data UMKM <svg width="40"
                                                height="40" fill="currentColor" class="bi bi-house-fill mb-2"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                                                <path
                                                    d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                                            </svg></h1>
                                        <form method="POST" action="{{ route('umkm.store') }}" id="umkmForm"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mb-2">
                                                <div class="col-sm-6">
                                                    <div class="mb-2">
                                                        <label for="nama_umkm" class="form-label">Nama UMKM
                                                            :</label>
                                                        <input type="text"
                                                            class="form-control @error('nama_umkm') is-invalid @enderror"
                                                            id="nama_umkm" name="nama_umkm"
                                                            placeholder="Masukkan Nama UMKM"
                                                            value="{{ old('nama_umkm') }}">
                                                        @error('nama_umkm')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="form-label col-sm-4" for="kota_umkm">Kab/Kota :
                                                        </label style="font-size: 14px">
                                                        <select id="kota_umkm" name="kota_umkm"
                                                            class="form-control @error('kota_umkm') is-invalid @enderror">
                                                            <option value="0"
                                                                {{ old('kota_umkm') == '0' ? 'selected' : '' }}>Pilih
                                                                Kab/Kota
                                                                UMKM
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
                                                    <div class="mb-2">
                                                        <label for="lokasi_umkm" class="form-label">Lokasi
                                                            :</label>
                                                        <input type="text"
                                                            class="form-control @error('lokasi_umkm') is-invalid @enderror"
                                                            id="lokasi_umkm" name="lokasi_umkm"
                                                            placeholder="Masukkan Lokasi Maps"
                                                            value="{{ old('lokasi_umkm') }}">
                                                        @error('lokasi_umkm')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="kontak" class="form-label">Nomor WhatsApp
                                                            :</label>
                                                        <input type="number"
                                                            class="form-control @error('kontak') is-invalid @enderror"
                                                            id="kontak" name="kontak"
                                                            placeholder="Masukkan Nomor WhatsApp UMKM"
                                                            value="{{ old('kontak') }}">
                                                        @error('kontak')
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
                                                                rows="4" placeholder="Masukkan Deskripsi UMKM">{{ old('deskripsi') }}</textarea>
                                                            @error('deskripsi')
                                                                <div class="text-danger mt-2">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="foto_umkm_input" class="form-label">Select a
                                                            file <i class="bi bi-image"></i>
                                                            (Foto Lokasi UMKM*) : <svg style="cursor: pointer;"
                                                                viewBox="0 0 24 24" fill="black" width="24"
                                                                height="24">
                                                                <path
                                                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z" />
                                                            </svg></label>
                                                        <input type="file"
                                                            class="d-none @error('foto_umkm') is-invalid @enderror"
                                                            id="foto_umkm_input" name="foto_umkm">
                                                        @if (isset($umkm) && $umkm->foto_umkm)
                                                            <div
                                                                class="mx-5 bg-white border border-dark border-3 rounded text-muted text-center fw-bold py-2">
                                                                <img id="fotoUmkmPreview"
                                                                    src="{{ asset('storage/' . $umkm->foto_umkm) }}"
                                                                    width="180px" height="100px"
                                                                    style="object-fit: cover;"
                                                                    alt="Upload Foto Lokasi UMKM">
                                                            </div>
                                                        @else
                                                            <div
                                                                class="mx-5 bg-white border border-dark border-3 rounded text-muted text-center fw-bold py-3">
                                                                <img id="fotoUmkmPreview" width="180px" height="100px"
                                                                    style="object-fit: cover;"
                                                                    alt="Upload Foto Lokasi UMKM">
                                                            </div>
                                                        @endif
                                                        @error('foto_umkm')
                                                            <div class="text-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 my-2 text-center">
                                                    <button type="submit" id="createBtn"
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

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to preview image before upload
            function previewImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#fotoUmkmPreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Trigger file input on clicking the edit icon
            $('#editIcon').click(function() {
                $('#foto_umkm_input').click();
            });

            // Call the previewImage function when selecting a file
            $('#foto_umkm_input').change(function() {
                previewImage(this);
            });
        });

        $('#foto_umkm_input').on('change', function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#fotoUmkmPreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

        // Fungsi untuk menutup notifikasi secara manual
        function closeNotification() {
            document.querySelector('.alert').style.display = 'none';
        }
    </script>
@endpush
