@extends('layout.main')
@section('title', 'Add User')
@section('content')
    <!-- Add User Section -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid px-4">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 fw-bold">Tambah Data User</h1>
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
                        <form class="mt-3" action="{{ route('page.admin.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-1">
                                <label for="nama" class="form-label fw-semibold">Nama User</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" placeholder="Masukkan nama user" value="{{ old('nama') }}">
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="Masukkan email user" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="Masukkan password user" value="{{ old('password') }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="password_confirmation" class="form-label fw-semibold">Confirm
                                    Password</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Masukkan konfirmasi password user">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-1 mt-3">
                                <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin</label>
                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                    name="jenis_kelamin">
                                    <option value="0" {{ old('jenis_kelamin') == '0' ? 'selected' : '' }}>Select Jenis
                                        Kelamin</option>
                                    <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                                @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="no_wa" class="form-label fw-semibold">No. WA</label>
                                <input type="string" class="form-control @error('no_wa') is-invalid @enderror"
                                    name="no_wa" placeholder="Masukkan no. wa user" value="{{ old('no_wa') }}">
                                @error('no_wa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    name="tanggal_lahir" placeholder="Masukkan tanggal lahir user"
                                    value="{{ old('tanggal_lahir') }}">
                                @error('tanggal_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="alamat" class="form-label fw-semibold">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" placeholder="Masukkan alamat user" value="{{ old('alamat') }}">
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- <div class="mb-1 mt-3 mb-3">
                                <label for="role" class="form-label fw-semibold">Role</label>
                                <select class="form-select @error('role') is-invalid @enderror" name="role">
                                    <option selected disabled>Select Role</option>
                                    <option value="superadmin">SuperAdmin</option>
                                    <option value="user">User</option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}
                            <div class="d-flex">
                                <div class="mx-auto mt-2">
                                    <a href="{{ route('page.admin.dashboard') }}" class="btn btn-warning me-2">
                                        Kembali</a>
                                    <button class="btn btn-info" type="submit">Submit</button>
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
