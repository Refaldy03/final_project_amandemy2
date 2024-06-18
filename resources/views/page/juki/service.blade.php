@extends('layout.app')
@section('title', 'Service')
@section('content')
    <!-- Service Section -->
    <div class="container my-5">
        <div class="row justify-content-center px-4">
            <div class="col-md-12">
                <div class="p-4 text-white" style="background-color: rgba(0, 0, 0, 0.9);">
                    <div>
                        <h1 class="h2 mb-5 text-center fw-bold">Service</h1>
                    </div>
                    <div class="mx-5 mt-4 mb-2">
                        <div>
                            <h2 class="h5 fw-bold mb-4">Langkah-Langkah Akses Website JUKI :</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h3 class="h6">1. Jika ingin masuk ke website JUKI, Pada halaman home tekan button
                                    login.
                                </h3>
                                <img src="{{ asset('images/home1.png') }}" width="500px" height="450px"
                                    class="img-fluid rounded border border-dark border-2" alt="Foto Rey"
                                    style="object-fit: cover;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <h3 class="h6">2. Setelah itu akan muncul halaman login, jika belum punya akun pilih
                                    register.</h3>
                                <img src="{{ asset('images/login1.png') }}" width="500px" height="450px"
                                    class="img-fluid rounded border border-dark border-2" alt="Foto Rey"
                                    style="object-fit: cover;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h3 class="h6">3. Maka akan muncul ke halaman registrasi dan isi data yang sesuai lalu
                                    tekan submit.
                                </h3>
                                <img src="{{ asset('images/registrasi.png') }}" width="500px" height="450px"
                                    class="img-fluid rounded border border-dark border-2" alt="Foto Rey"
                                    style="object-fit: cover;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <h3 class="h6">4. Akan muncul kembali ke halaman login dan masukkan email serta password
                                    yang
                                    telah didaftarkan saat registrasi tadi.</h3>
                                <img src="{{ asset('images/login2.png') }}" width="500px" height="450px"
                                    class="img-fluid rounded border border-dark border-2" alt="Foto Rey"
                                    style="object-fit: cover;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h3 class="h6">5. Jika login berhasil maka akan masuk ke halaman utama atau home website
                                    milik anda dan website sudah dapat digunakan sesuai kebutuhan anda masing-masing.
                                </h3>
                                <img src="{{ asset('images/home2.png') }}" width="500px" height="450px"
                                    class="img-fluid rounded border border-dark border-2" alt="Foto Rey"
                                    style="object-fit: cover;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <h3 class="h6">6. Lalu tekan email akan muncul pilihan menu dashboard
                                    untuk mendaftarkan UMKM, profil untuk biodata akun pengguna, loker untuk menambahkan
                                    lowongan pekerjaan dan logout untuk keluar.
                                </h3>
                                <img src="{{ asset('images/home3.png') }}" width="500px" height="450px"
                                    class="img-fluid rounded border border-dark border-2" alt="Foto Rey"
                                    style="object-fit: cover;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 m-3">
                                <h3 class="h6 text-center">Semoga layanan webiste kami dapat bermanfaat dan membantu anda,
                                    <br>jika terdapat kendala silahkan hubungi kontak kami, terima kasih.
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
