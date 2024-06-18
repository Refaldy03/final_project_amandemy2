<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    @stack('styles')
    <style>
        /* CSS khusus untuk halaman login */
        .login-background {
            background-image: url('{{ asset('images/background.png') }}') !important;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* CSS umum untuk halaman lain */
        .default-background {
            background-image: url('{{ asset('images/bg.png') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        body {
            max-width: 100%;
            /* Batas lebar maksimum */
            margin: 0 auto;
            /* Memusatkan elemen secara horizontal */
            overflow-x: hidden;
            /* Menghindari scroll horizontal yang tidak diinginkan */
        }

        /* CSS untuk menambahkan efek hover */
        .dropdown-item:hover {
            background-color: rgba(0, 0, 0, 0.5);
            /* Warna tipis saat hover */
        }

        /* CSS untuk menandai menu yang aktif */
        .dropdown-item.active {
            background-color: rgba(0, 0, 0, 10);
            /* Warna tipis untuk menu aktif */
        }

        /* CSS untuk animasi geser ke kiri */
        .page-transition {
            animation: slideToLeft 0.5s ease;
        }

        @keyframes slideToLeft {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(0);
            }
        }

        /* CSS untuk semua button */
        .btn {
            font-weight: bold;
            font-family: Calibri;
        }

        /* CSS untuk navbar dropdown yg active */
        .nav-link.dropdown-toggle.clicked {
            color: DeepSkyBlue !important;
            /* Warna teks menjadi biru saat ditekan */
            font-weight: bold;
            /* Membuat teks menjadi bold */
        }
    </style>
</head>

<body class="{{ Request::is('login') ? 'login-background' : 'default-background' }}">
    <!-- Navbar -->
    @if ($navbar === 'navbarHome')
        @include('component.navbarHome')
    @elseif ($navbar === 'navbarUmkm_InfoLoker')
        @include('component.navbarUmkm_InfoLoker')
    @elseif ($navbar === 'navbarAboutUs_Service')
        @include('component.navbarAboutUs_Service')
    @elseif ($navbar === 'navbarDashboard_Profil_Loker')
        @include('component.navbarDashboard_Profil_Loker')
    @elseif ($navbar === 'navbarLogin')
        @include('component.navbarLogin')
    @endif

    <!-- Halaman content -->
    <main class="flex-shrink-0 @if (!Request::is('login')) page-transition @endif"
        style="width: auto; max-height: 100vh; overflow: auto;">
        @yield('content')
    </main>

    <!-- Footer Section -->
    @if ($footer === 'footer')
        @include('component.footer')
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.nav-link.dropdown-toggle').click(function() {
                // Tambahkan kelas 'clicked' saat item ditekan
                $(this).addClass('clicked');
            });

            // Tangkap event saat dropdown ditutup
            $('.dropdown').on('hide.bs.dropdown', function() {
                $(this).find('.nav-link.dropdown-toggle').removeClass('clicked');
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
