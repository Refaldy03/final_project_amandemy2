@extends('layout.app')
@section('title', 'Home')
@section('content')
    <!-- Home Section -->
    <div class="container my-5">
        <div class="row align-items-center mx-2 px-4 py-4" style="background-color: rgba(0, 0, 0, 0.9);">
            <div class="col-md-5 my-5">
                <img src="{{ asset('images/gambar-hero.png') }}" class="img-fluid mx-auto d-block" alt="Gambar Hero">
            </div>
            <div class="col-md-7 d-flex flex-column justify-content-center">
                <div class="ms-md-5 text-white">
                    <h1 class="h4">Hallo!</h1>
                    <h5 class="h1 fw-bold text-info">
                        Selamat Datang di JUKI!
                    </h5>
                    <p class="fw-semibold">
                        <b>Jaringan Usaha Kecil Indonesia.</b>
                        <br>Terkoneksi dengan Kreativitas Lokal: Temukan keunikan produk lokal kami
                        <br> yang penuh inspirasi dan cerita di halaman ini. Mari bergabung dalam perjalanan kami
                        menuju keberlanjutan dan keindahan, satu kreasi demi satu kreasi.
                    </p>
                    <button class="btn btn-primary fw-bold w-auto"
                        onclick="window.location.href='{{ route('login') }}';">Join Now!</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Saran UMKM Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="pt-5 pb-3" style="background-color: rgba(0, 0, 0, 0.9);">
                    <h1 class="h4 text-center fw-bold bg-white py-3 px-3">SARAN UMKM</h1>
                    <div class="grid mx-5 mt-4 mb-2">
                        <div class="row row-gap-3" id="umkmContainer">
                            @foreach ($umkms as $umkm)
                                <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                    @if (Auth::check())
                                        <a href="{{ route('detailUmkm', $umkm->id) }}" class="text-decoration-none">
                                        @else
                                            <a href="{{ route('login') }}" class="text-decoration-none">
                                    @endif
                                    <div class="card w-100 h-100" style="background-color: rgb(243, 198, 240)">
                                        <img class="card-img-top rounded img-fluid"
                                            style="object-fit: cover; height: 150px;"
                                            src="{{ asset('storage/umkm_images/' . $umkm->foto_umkm) }}"
                                            alt="{{ $umkm->nama_umkm }}">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between my-auto" style="font-size: 18px">
                                                <p class="card-title text-dark fw-bold my-auto">
                                                    {{ $umkm->nama_umkm }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between flex-wrap mt-2">
                                                <div class="text-start mb-2 mb-md-1">
                                                    <p class="my-auto rounded bg-dark text-white py-1 px-2 fw-semibold"
                                                        style="font-size: 14px">{{ $umkm->kota_umkm }}</p>
                                                </div>
                                                <div class="text-end">
                                                    @if (Auth::check())
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
                                                    @else
                                                        <a class="my-auto rounded py-1 bg-success px-2 fw-bold text-dark text-decoration-none"
                                                            style="font-size: 14px; cursor: not-allowed;"
                                                            title="Login required">
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
                                                            </svg>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            <p
                                                style="font-size: 14px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; margin: 10px auto;">
                                                {{ $umkm->deskripsi }}</p>
                                            @if (Auth::check())
                                                <a href="https://wa.me/{{ $umkm->kontak }}"
                                                    class="btn btn-primary btn-sm w-100 fw-bold mt-auto">
                                                    Hubungi Kontak
                                                    <svg class="bg-success rounded-circle mb-1" width="20"
                                                        height="20" fill="currentColor" class="bi bi-whatsapp"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @else
                                                <a href="{{ route('login') }}"
                                                    class="btn btn-primary btn-sm w-100 fw-bold mt-auto">
                                                    Hubungi Kontak
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
