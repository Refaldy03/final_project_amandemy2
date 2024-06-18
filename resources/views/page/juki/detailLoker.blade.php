@extends('layout.app')
@section('title', 'Detail Loker')
@section('content')
    <!-- Detail Loker Section -->
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
                <div class="py-2" style="background-color: rgba(0, 0, 0, 0.9);">
                    <div class="mx-5 mt-4 mb-2">
                        <div class="row d-flex justify-content-center">
                            <div class="col-sm-10 mb-3">
                                <div class="card w-100 h-100" style="background-color: rgb(243, 198, 240)">
                                    <!-- Profile Section -->
                                    <div class="container">
                                        <div class="row">
                                            <div class="col mt-4 mb-4 pt-4 mx-4 rounded" style="background-color: black">
                                                <p class="h5 mb-4 fw-bold text-white text-center" style="font-size: 18px">
                                                    Profile
                                                    UMKM <svg width="30" height="30" fill="currentColor"
                                                        class="bi bi-person-circle mb-2" viewBox="0 0 16 16">
                                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                                        <path fill-rule="evenodd"
                                                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                                    </svg></p>
                                                <div class="row mb-4 ps-5 text-white"
                                                    style="max-height: 240px; overflow-y: auto;">
                                                    <div class="col-md-3 d-flex justify-content-center">
                                                        @if ($umkm->user->profile && $umkm->user->profile->foto_profile)
                                                            <img src="{{ asset('storage/' . $umkm->user->profile->foto_profile) }}"
                                                                width="100px" height="100px"
                                                                class="rounded-circle border border-dark"
                                                                style="object-fit: cover; border-radius: 50px;"
                                                                alt="Profile Image">
                                                        @else
                                                            <img src="{{ asset('storage/profile_images/default_profile.png') }}"
                                                                width="100px" class="img-fluid rounded-circle"
                                                                alt="Default Profile Image">
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4 d-flex justify-content-start">
                                                        <div class="mx-2">
                                                            <h1 class="h6 fw-bold mb-0 pt-1">Nama Owner</h1>
                                                            <h1 class="h6 fw-bold mb-0 pt-1">Email</h1>
                                                            <h1 class="h6 fw-bold mb-0 pt-1"> Nomor WhatsApp</h1>
                                                            <h1 class="h6 fw-bold mb-0 pt-1"> Alamat Rumah</h1>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="mx-2">
                                                            <h1 class="h6 fw-bold mb-0 pt-1">
                                                                {{ $umkm->user->nama }}</h1>
                                                            <h1 class="h6 fw-bold mb-0 pt-1">
                                                                {{ $umkm->user->email }}</h1>
                                                            <h1 class="h6 fw-bold mb-0 pt-1">
                                                                {{ $umkm->user->no_wa }}</h1>
                                                            <h1 class="h6 fw-bold mb-0 pt-1">
                                                                {{ $umkm->user->alamat }}</h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Loker Section-->
                                    <div class="row mx-4">
                                        <div class="col-lg-6 py-4 ps-4">
                                            <img class="card-img rounded img-fluid border border-dark"
                                                style="object-fit: cover; weight: auto; height: 250px;"
                                                src="{{ asset('storage/umkm_images/' . $umkm->foto_umkm) }}"
                                                alt="{{ $umkm->nama_umkm }}">
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card-body my-4" style="max-height: 250px; overflow-y: auto;">
                                                <p class="card-title fw-bold my-auto" style="font-size: 25px">
                                                    {{ $umkm->nama_umkm }}</p>
                                                <div class="d-flex justify-content-between flex-wrap my-2">
                                                    <div class="text-start mb-2 mb-md-1">
                                                        <p class="my-auto rounded bg-dark text-white py-1 px-2 fw-semibold"
                                                            style="font-size: 14px">{{ $umkm->kota_umkm }}</p>
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
                                                <p class="fw-bold text-start m-0"
                                                    style="font-size: 14px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; margin: 10px auto;">
                                                    {{ $loker->jumlah_loker }} Posisi {{ $loker->posisi_loker }}
                                                </p>
                                                <p style="font-size: 14px;">
                                                    {{ $loker->kualifikasi }}</p>
                                                <a href="mailto:{{ $loker->user->email }}"
                                                    class="w-100 my-auto rounded py-1 btn btn-warning btn-block px-2 fw-bold text-primary text-decoration-none"
                                                    style="font-size: 14px">Kirim Email <svg class="mb-1" weight="17px"
                                                        height="17px" fill="#007bff" class="bi bi-envelope"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M0 4.516V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.516l-8 5.333-8-5.333zm1-1L8 9.849 15 3V2H1v1.516z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
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
