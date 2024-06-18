@extends('layout.app')
@push('styles')
    <style>
        .form-label {
            font-weight: bold;
        }
    </style>
@endpush
@section('title', 'Profil')
@section('content')
    <!-- Profil Section -->
    <div class="container my-5">
        <div class="row justify-content-center px-4">
            <div class="col-sm-9">
                <a class="btn btn-dark border-3 border-primary mb-4 fw-bold" href="{{ url()->previous() }}"><svg class="me-2"
                        viewBox="0 0 24 24" aria-hidden="true" fill="currentColor" weight="20px" height="20px">
                        <g>
                            <path d="M7.414 13l5.043 5.04-1.414 1.42L3.586 12l7.457-7.46 1.414 1.42L7.414 11H21v2H7.414z">
                            </path>
                        </g>
                    </svg>Back</a>

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

                <div class="card mx-auto py-5 px-5" style="background-color: rgba(0, 0, 0, 0.7);">
                    <div class="card-body rounded px-4 border border-3 border-dark"
                        style="background-color: rgba(70, 130, 180)">
                        <h1 class="h2 mb-4 fw-bold text-center">Hallo User!</h1>
                        <div class="row my-3">
                            <div class="col-md-12 d-flex justify-content-center">
                                <img src="{{ $profile && $profile->foto_profile ? asset('storage/' . $profile->foto_profile) : asset('storage/profile_images/default_profile.png') }}"
                                    width="100px" height="100px" class="rounded-circle"
                                    style="object-fit: cover; border-radius: 25px;" id="profileImagePreview"
                                    alt="Profil image">
                                <label for="profileImageInput" style="bottom: 0; right: 0; cursor: pointer;"><svg
                                        class="bg-white rounded-circle py-1 px-1"
                                        style="margin-top: 65px;margin-left: -31px" viewBox="0 0 24 24" aria-hidden="true"
                                        fill="black" width="30px" height="30px" id="editIcon;">
                                        <g>
                                            <path
                                                d="M9.697 3H11v2h-.697l-3 2H5c-.276 0-.5.224-.5.5v11c0 .276.224.5.5.5h14c.276 0 .5-.224.5-.5V10h2v8.5c0 1.381-1.119 2.5-2.5 2.5H5c-1.381 0-2.5-1.119-2.5-2.5v-11C2.5 6.119 3.619 5 5 5h1.697l3-2zM12 10.5c-1.105 0-2 .895-2 2s.895 2 2 2 2-.895 2-2-.895-2-2-2zm-4 2c0-2.209 1.791-4 4-4s4 1.791 4 4-1.791 4-4 4-4-1.791-4-4zM17 2c0 1.657-1.343 3-3 3v1c1.657 0 3 1.343 3 3h1c0-1.657 1.343-3 3-3V5c-1.657 0-3-1.343-3-3h-1z">
                                            </path>
                                        </g>
                                    </svg>
                                </label>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-2">
                                <div class="mb-3">
                                    <input type="file" id="profileImageInput" name="foto_profile"
                                        class="d-none @error('foto_profile') is-invalid @enderror">
                                    @error('foto_profile')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email :</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email"
                                            value="{{ old('email') ? old('email') : $user->email }}"
                                            placeholder="Masukkan Alamat Email Anda">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Kata Sandi <button type="button"
                                                class="toggle-password" data-target="#password"
                                                style="background:none; border: none;" aria-label="Perlihatkan kata sandi">
                                                <svg class="show-password-icon d-none" viewBox="0 0 24 24"
                                                    aria-hidden="true" fill="black" width="25px" height="25px">
                                                    <g>
                                                        <path
                                                            d="M3.693 21.707l-1.414-1.414 2.429-2.429c-2.479-2.421-3.606-5.376-3.658-5.513l-.131-.352.131-.352c.133-.353 3.331-8.648 10.937-8.648 2.062 0 3.989.621 5.737 1.85l2.556-2.557 1.414 1.414L3.693 21.707zm-.622-9.706c.356.797 1.354 2.794 3.051 4.449l2.417-2.418c-.361-.609-.553-1.306-.553-2.032 0-2.206 1.794-4 4-4 .727 0 1.424.192 2.033.554l2.263-2.264C14.953 5.434 13.512 5 11.986 5c-5.416 0-8.258 5.535-8.915 7.001zM11.986 10c-1.103 0-2 .897-2 2 0 .178.023.352.067.519l2.451-2.451c-.167-.044-.341-.067-.519-.067zm10.951 1.647l.131.352-.131.352c-.133.353-3.331 8.648-10.937 8.648-.709 0-1.367-.092-2-.223v-2.047c.624.169 1.288.27 2 .27 5.415 0 8.257-5.533 8.915-7-.252-.562-.829-1.724-1.746-2.941l1.438-1.438c1.53 1.971 2.268 3.862 2.33 4.027z">
                                                        </path>
                                                    </g>
                                                </svg>
                                                <svg class="hide-password-icon" viewBox="0 0 24 24" aria-hidden="true"
                                                    fill="black" width="25px" height="25px">
                                                    <g>
                                                        <path
                                                            d="M12 21c-7.605 0-10.804-8.296-10.937-8.648L.932 12l.131-.352C1.196 11.295 4.394 3 12 3s10.804 8.296 10.937 8.648l.131.352-.131.352C22.804 12.705 19.606 21 12 21zm-8.915-9c.658 1.467 3.5 7 8.915 7s8.257-5.533 8.915-7c-.658-1.467-3.5-7-8.915-7s-8.257 5.533-8.915 7zM12 16c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4zm0-6c-1.103 0-2 .897-2 2s.897 2 2 2 2-.897 2-2-.897-2-2-2z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </button> :</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" value="{{ old('password') }}"
                                            placeholder="Masukkan Kata Sandi Anda">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Password
                                            Confirmation <button type="button" class="toggle-password"
                                                data-target="#password_confirmation"
                                                style="background:none; border: none;"
                                                aria-label="Perlihatkan kata sandi">
                                                <svg class="show-password-icon d-none" viewBox="0 0 24 24"
                                                    aria-hidden="true" fill="black" width="25px" height="25px">
                                                    <g>
                                                        <path
                                                            d="M3.693 21.707l-1.414-1.414 2.429-2.429c-2.479-2.421-3.606-5.376-3.658-5.513l-.131-.352.131-.352c.133-.353 3.331-8.648 10.937-8.648 2.062 0 3.989.621 5.737 1.85l2.556-2.557 1.414 1.414L3.693 21.707zm-.622-9.706c.356.797 1.354 2.794 3.051 4.449l2.417-2.418c-.361-.609-.553-1.306-.553-2.032 0-2.206 1.794-4 4-4 .727 0 1.424.192 2.033.554l2.263-2.264C14.953 5.434 13.512 5 11.986 5c-5.416 0-8.258 5.535-8.915 7.001zM11.986 10c-1.103 0-2 .897-2 2 0 .178.023.352.067.519l2.451-2.451c-.167-.044-.341-.067-.519-.067zm10.951 1.647l.131.352-.131.352c-.133.353-3.331 8.648-10.937 8.648-.709 0-1.367-.092-2-.223v-2.047c.624.169 1.288.27 2 .27 5.415 0 8.257-5.533 8.915-7-.252-.562-.829-1.724-1.746-2.941l1.438-1.438c1.53 1.971 2.268 3.862 2.33 4.027z">
                                                        </path>
                                                    </g>
                                                </svg>
                                                <svg class="hide-password-icon" viewBox="0 0 24 24" aria-hidden="true"
                                                    fill="black" width="25px" height="25px">
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
                                            placeholder="Konfirmasi Kata Sandi Anda" required>
                                        @error('password_confirmation')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap :</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama"
                                            value="{{ old('nama') ? old('nama') : $user->nama }}"
                                            placeholder="Masukkan Nama Lengkap Anda">
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Domisili :</label>
                                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            id="alamat" name="alamat"
                                            value="{{ old('alamat') ? old('alamat') : $user->alamat }}"
                                            placeholder="Masukkan Domisili Anda">
                                        @error('alamat')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_wa" class="form-label">Nomor WhatsApp
                                            :</label>
                                        <input type="number" class="form-control" id="no_wa" name="no_wa"
                                            value="{{ old('no_wa') ? old('no_wa') : $user->no_wa }}"
                                            placeholder="Masukkan Nomor WhatsApp Anda">
                                        @error('no_wa')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="ktpImageInput" class="form-label">Select a file :
                                            <br><i class="bi bi-image"></i> (Foto KTP/KTM/Kartu
                                            Pelajar*) <svg style="cursor: pointer;" viewBox="0 0 24 24" fill="black"
                                                width="24" height="24">
                                                <path
                                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z" />
                                            </svg></label>
                                        <input type="file" class="d-none @error('ktp') is-invalid @enderror"
                                            id="ktpImageInput" name="ktp">
                                        @if (isset($profile) && $profile->ktp)
                                            <div class="text-center">
                                                <img id="ktpImagePreview"
                                                    class="mx-5 border border-dark border-3 rounded fw-bold"
                                                    src="{{ asset('storage/' . $profile->ktp) }}" width="180px"
                                                    height="100px" class="border border-dark border-3 rounded"
                                                    style="object-fit: cover;" alt="KTP Image">
                                            </div>
                                        @else
                                            <div
                                                class="mx-4 bg-white border border-dark border-3 rounded text-muted text-center fw-bold py-3">
                                                <img id="ktpImagePreview" width="180px" height="100px"
                                                    style="object-fit: cover;" alt="Upload Foto KTP">
                                            </div>
                                        @endif
                                        @error('ktp')
                                            <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-2 text-center">
                                    <button type="submit" class="btn btn-success border border-black border-2 mt-2"><i
                                            class="bi bi-save"></i> Simpan
                                        Data</button>
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
        $(document).ready(function() {
            // Function to preview image before upload
            function previewImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#profileImagePreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Trigger file input on clicking the edit icon
            $('#editIcon').click(function() {
                $('#profileImageInput').click();
            });

            // Call the previewImage function when selecting a file
            $('#profileImageInput').change(function() {
                previewImage(this);
            });
        });

        $('#ktpImageInput').on('change', function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#ktpImagePreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });

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
