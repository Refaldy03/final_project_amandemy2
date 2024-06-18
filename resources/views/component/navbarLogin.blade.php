<!-- Navbar Login-->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <!-- Logo Website JUKI -->
            <a class="navbar-brand ms-4" href="{{ route('juki.index') }}">
                <img src="{{ asset('images/logo.png') }}" width="50" height="50" alt="Logo JUKI">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <!-- Menu Halaman Home -->
                    <li class="nav-item">
                        <a class="nav-link active text-white fw-bold" aria-current="page"
                            href="{{ route('juki.index') }}">Home</a>
                    </li>
                    <!-- Menu Halaman About Us -->
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="{{ route('about') }}">About
                            Us</a>
                    </li>
                    <!-- Menu Halaman Contact Us -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Contact Us
                        </a>
                        <ul class="dropdown-menu bg-dark border-3 border-primary" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="https://www.instagram.com/juki_officially/"
                                    target="_blank" style="color: rgb(230, 51, 170);">Instagram</a></li>
                            <li><a class="dropdown-item" href="https://www.facebook.com/lintang.p.dynia/"
                                    target=" _blank" style="color: rgb(96, 96, 202);">Facebook</a></li>
                            <li><a class="dropdown-item" href="https://api.whatsapp.com/send?phone=62895424556262"
                                    target="_blank" style="color: rgb(22, 160, 56);">WhatsApp</a></li>
                        </ul>
                    </li>
                    <!-- Menu Halaman Service -->
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="{{ route('service') }}">Service</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
