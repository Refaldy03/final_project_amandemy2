@extends('layout.app')
@section('title', 'Login')
@section('content')
    <!-- Login Section -->
    <div class="container-fluid">
        <div class="row">
            <!-- Bagian Kiri: Logo -->
            <div class="col-lg-6 bg-primary text-white text-center d-flex align-items-center justify-content-center">
                <div class="col-sm-6 bg-dark py-5" style="border-bottom-left-radius: 50px; border-top-right-radius: 50px;">
                    <img src="{{ asset('images/logo.png') }}" width="300px" height="300px" alt="Logo JUKI">
                </div>
            </div>
            <!-- Bagian Kanan: Form Login -->
            <div class="col-lg-6 my-4 p-5">
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
                    <div class=" mt-4 mb-3">
                        <h1 class="h4 fw-bold text-start">Welcome Back
                        </h1>
                        <p class="text-start text-secondary fw-bold">Selamat datang di website kami</p>
                    </div>
                    <form action="{{ route('login.authenticate') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <input type="email" class="form-control rounded @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Masukkan Email Anda" required
                                    autocomplete="email" autofocus>
                                <svg style="background-color: none; border: none; position: absolute; right: 17px; top: 50%; transform: translateY(-50%);"
                                    weight="20px" height="20px" fill="black" class="bi bi-envelope" viewBox="0 0 16 16">
                                    <path
                                        d="M0 4.516V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.516l-8 5.333-8-5.333zm1-1L8 9.849 15 3V2H1v1.516z" />
                                </svg>
                            </div>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control rounded @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Masukkan Password Anda" required
                                    autocomplete="current-password">
                                <button type="button" class="toggle-password" data-target="#password"
                                    style="background: none; border: none; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"
                                    aria-label="Perlihatkan kata sandi">
                                    <svg class="show-password-icon d-none" viewBox="0 0 24 24" aria-hidden="true"
                                        fill="black" width="25px" height="25px">
                                        <g>
                                            <path
                                                d="M3.693 21.707l-1.414-1.414 2.429-2.429c-2.479-2.421-3.606-5.376-3.658-5.513l-.131-.352.131-.352c.133-.353 3.331-8.648 10.937-8.648 2.062 0 3.989.621 5.737 1.85l2.556-2.557 1.414 1.414L3.693 21.707zm-.622-9.706c.356.797 1.354 2.794 3.051 4.449l2.417-2.418c-.361-.609-.553-1.306-.553-2.032 0-2.206 1.794-4 4-4 .727 0 1.424.192 2.033.554l2.263-2.264C14.953 5.434 13.512 5 11.986 5c-5.416 0-8.258 5.535-8.915 7.001zM11.986 10c-1.103 0-2 .897-2 2 0 .178.023.352.067.519l2.451-2.451c-.167-.044-.341-.067-.519-.067zm10.951 1.647l.131.352-.131.352c-.133.353-3.331 8.648-10.937 8.648-.709 0-1.367-.092-2-.223v-2.047c.624.169 1.288.27 2 .27 5.415 0 8.257-5.533 8.915-7-.252-.562-.829-1.724-1.746-2.941l1.438-1.438c1.53 1.971 2.268 3.862 2.33 4.027z">
                                            </path>
                                        </g>
                                    </svg>
                                    <svg class="hide-password-icon" viewBox="0 0 24 24" aria-hidden="true" fill="black"
                                        width="25px" height="25px">
                                        <g>
                                            <path
                                                d="M12 21c-7.605 0-10.804-8.296-10.937-8.648L.932 12l.131-.352C1.196 11.295 4.394 3 12 3s10.804 8.296 10.937 8.648l.131.352-.131.352C22.804 12.705 19.606 21 12 21zm-8.915-9c.658 1.467 3.5 7 8.915 7s8.257-5.533 8.915-7c-.658-1.467-3.5-7-8.915-7s-8.257 5.533-8.915 7zM12 16c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4zm0-6c-1.103 0-2 .897-2 2s.897 2 2 2 2-.897 2-2-.897-2-2-2z">
                                            </path>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-block" type="submit">LOGIN</button>
                        </div>
                        <div class="text-center mt-4">
                            <p>Don't have an account? <a class="text-decoration-none fw-bold"
                                    href="{{ route('register') }}">Register</a></p>
                        </div>
                    </form>
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
