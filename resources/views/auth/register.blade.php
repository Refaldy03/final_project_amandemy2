@extends('layout.app')
@section('title', 'Register')
@section('content')
    <!-- Register Section -->
    <div class="container-fluid text-white py-5">
        <div class="row justify-content-center py-4">
            <div class="col-md-12 col-lg-10">

                <div class="mx-5">
                    <!-- error message -->
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- success message -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>

                <div class="card mx-5 px-4 bg-dark">
                    <div class="card-body rounded">
                        <h1 class="h4 fw-bold">Registrasi</h1>
                        <h2 class="mb-4 fw-bold text-center">Formulir Pendaftaran</h2>
                        <p>Isilah data pendaftaran ini dengan benar :</p>
                        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama :</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" placeholder="Masukkan Nama Anda"
                                            value="{{ old('nama') }}">
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir :</label>
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                        @error('tanggal_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin :</label>
                                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="0" {{ old('jenis_kelamin') == '0' ? 'selected' : '' }}>
                                                Select Jenis Kelamin</option>
                                            <option value="laki-laki"
                                                {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="perempuan"
                                                {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>
                                                Perempuan
                                            </option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="alamat">Alamat :</label>
                                        <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                            placeholder="Masukkan Alamat Anda">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address :</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Masukkan Email Anda"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password <button type="button"
                                                class="bg-dark toggle-password" data-target="#password"
                                                style="border: none;" aria-label="Perlihatkan kata sandi">
                                                <svg class="show-password-icon d-none" viewBox="0 0 24 24"
                                                    aria-hidden="true" fill="white" width="25px" height="25px">
                                                    <g>
                                                        <path
                                                            d="M3.693 21.707l-1.414-1.414 2.429-2.429c-2.479-2.421-3.606-5.376-3.658-5.513l-.131-.352.131-.352c.133-.353 3.331-8.648 10.937-8.648 2.062 0 3.989.621 5.737 1.85l2.556-2.557 1.414 1.414L3.693 21.707zm-.622-9.706c.356.797 1.354 2.794 3.051 4.449l2.417-2.418c-.361-.609-.553-1.306-.553-2.032 0-2.206 1.794-4 4-4 .727 0 1.424.192 2.033.554l2.263-2.264C14.953 5.434 13.512 5 11.986 5c-5.416 0-8.258 5.535-8.915 7.001zM11.986 10c-1.103 0-2 .897-2 2 0 .178.023.352.067.519l2.451-2.451c-.167-.044-.341-.067-.519-.067zm10.951 1.647l.131.352-.131.352c-.133.353-3.331 8.648-10.937 8.648-.709 0-1.367-.092-2-.223v-2.047c.624.169 1.288.27 2 .27 5.415 0 8.257-5.533 8.915-7-.252-.562-.829-1.724-1.746-2.941l1.438-1.438c1.53 1.971 2.268 3.862 2.33 4.027z">
                                                        </path>
                                                    </g>
                                                </svg>
                                                <svg class="hide-password-icon" viewBox="0 0 24 24" aria-hidden="true"
                                                    fill="white" width="25px" height="25px">
                                                    <g>
                                                        <path
                                                            d="M12 21c-7.605 0-10.804-8.296-10.937-8.648L.932 12l.131-.352C1.196 11.295 4.394 3 12 3s10.804 8.296 10.937 8.648l.131.352-.131.352C22.804 12.705 19.606 21 12 21zm-8.915-9c.658 1.467 3.5 7 8.915 7s8.257-5.533 8.915-7c-.658-1.467-3.5-7-8.915-7s-8.257 5.533-8.915 7zM12 16c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4zm0-6c-1.103 0-2 .897-2 2s.897 2 2 2 2-.897 2-2-.897-2-2-2z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </button> :</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Masukkan Kata Sandi Anda"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Password
                                            Confirmation <button type="button" class="bg-dark toggle-password"
                                                data-target="#password_confirmation" style="border: none;"
                                                aria-label="Perlihatkan kata sandi">
                                                <svg class="show-password-icon d-none" viewBox="0 0 24 24"
                                                    aria-hidden="true" fill="white" width="25px" height="25px">
                                                    <g>
                                                        <path
                                                            d="M3.693 21.707l-1.414-1.414 2.429-2.429c-2.479-2.421-3.606-5.376-3.658-5.513l-.131-.352.131-.352c.133-.353 3.331-8.648 10.937-8.648 2.062 0 3.989.621 5.737 1.85l2.556-2.557 1.414 1.414L3.693 21.707zm-.622-9.706c.356.797 1.354 2.794 3.051 4.449l2.417-2.418c-.361-.609-.553-1.306-.553-2.032 0-2.206 1.794-4 4-4 .727 0 1.424.192 2.033.554l2.263-2.264C14.953 5.434 13.512 5 11.986 5c-5.416 0-8.258 5.535-8.915 7.001zM11.986 10c-1.103 0-2 .897-2 2 0 .178.023.352.067.519l2.451-2.451c-.167-.044-.341-.067-.519-.067zm10.951 1.647l.131.352-.131.352c-.133.353-3.331 8.648-10.937 8.648-.709 0-1.367-.092-2-.223v-2.047c.624.169 1.288.27 2 .27 5.415 0 8.257-5.533 8.915-7-.252-.562-.829-1.724-1.746-2.941l1.438-1.438c1.53 1.971 2.268 3.862 2.33 4.027z">
                                                        </path>
                                                    </g>
                                                </svg>
                                                <svg class="hide-password-icon" viewBox="0 0 24 24" aria-hidden="true"
                                                    fill="white" width="25px" height="25px">
                                                    <g>
                                                        <path
                                                            d="M12 21c-7.605 0-10.804-8.296-10.937-8.648L.932 12l.131-.352C1.196 11.295 4.394 3 12 3s10.804 8.296 10.937 8.648l.131.352-.131.352C22.804 12.705 19.606 21 12 21zm-8.915-9c.658 1.467 3.5 7 8.915 7s8.257-5.533 8.915-7c-.658-1.467-3.5-7-8.915-7s-8.257 5.533-8.915 7zM12 16c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4zm0-6c-1.103 0-2 .897-2 2s.897 2 2 2 2-.897 2-2-.897-2-2-2z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </button> :</label>
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            id="password_confirmation" name="password_confirmation"
                                            placeholder="Konfirmasi Kata Sandi Anda">
                                        @error('password_confirmation')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_wa" class="form-label">No. WhatsApp :</label>
                                        <input type="number" class="form-control @error('no_wa') is-invalid @enderror"
                                            id="no_wa" name="no_wa" placeholder="Masukkan Nomor WhatsApp Anda"
                                            value="{{ old('no_wa') }}">
                                        @error('no_wa')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-4 mb-1 text-center">
                                    <button type="submit" class="btn btn-primary mx-1">Kirim Data</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="button" class="btn btn-danger mx-1"
                                        onclick="window.location.href='{{ route('login') }}'">Kembali</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const target = document.querySelector(this.getAttribute('data-target'));
                const showIcon = this.querySelector('.show-password-icon');
                const hideIcon = this.querySelector('.hide-password-icon');

                if (target.type === 'password') {
                    target.type = 'text';
                    showIcon.classList.remove('d-none');
                    hideIcon.classList.add('d-none');
                } else {
                    target.type = 'password';
                    showIcon.classList.add('d-none');
                    hideIcon.classList.remove('d-none');
                }
            });
        });

        // Fungsi untuk menutup notifikasi secara manual
        function closeNotification() {
            document.querySelector('.alert').style.display = 'none';
        }
    </script>
@endpush
