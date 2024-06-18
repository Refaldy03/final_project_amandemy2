@extends('layout.app')
@section('title', 'Detail UMKM')
@section('content')
    <!-- Detail UMKM Section -->
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
                                    <div class="row mx-auto">
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
                                                    <div class="like-container">
                                                        <svg viewBox="0 0 24 24" aria-hidden="true" fill="red"
                                                            width="25px" height="25px" style="cursor: pointer;"
                                                            class="like-icon like-btn {{ $umkm->likes->where('user_id', auth()->id())->isNotEmpty() ? 'd-none' : '' }}"
                                                            data-likeable-id="{{ $umkm->id }}"
                                                            data-likeable-type="umkm">
                                                            <g>
                                                                <path
                                                                    d="M16.697 5.5c-1.222-.06-2.679.51-3.89 2.16l-.805 1.09-.806-1.09C9.984 6.01 8.526 5.44 7.304 5.5c-1.243.07-2.349.78-2.91 1.91-.552 1.12-.633 2.78.479 4.82 1.074 1.97 3.257 4.27 7.129 6.61 3.87-2.34 6.052-4.64 7.126-6.61 1.111-2.04 1.03-3.7.477-4.82-.561-1.13-1.666-1.84-2.908-1.91zm4.187 7.69c-1.351 2.48-4.001 5.12-8.379 7.67l-.503.3-.504-.3c-4.379-2.55-7.029-5.19-8.382-7.67-1.36-2.5-1.41-4.86-.514-6.67.887-1.79 2.647-2.91 4.601-3.01 1.651-.09 3.368.56 4.798 2.01 1.429-1.45 3.146-2.1 4.796-2.01 1.954.1 3.714 1.22 4.601 3.01.896 1.81.846 4.17-.514 6.67z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <svg viewBox="0 0 24 24" aria-hidden="true" fill="red"
                                                            width="25px" height="25px" style="cursor: pointer;"
                                                            class="like-icon-filled like-btn {{ $umkm->likes->where('user_id', auth()->id())->isNotEmpty() ? '' : 'd-none' }}"
                                                            data-likeable-id="{{ $umkm->id }}"
                                                            data-likeable-type="umkm">
                                                            <g>
                                                                <path
                                                                    d="M20.884 13.19c-1.351 2.48-4.001 5.12-8.379 7.67l-.503.3-.504-.3c-4.379-2.55-7.029-5.19-8.382-7.67-1.36-2.5-1.41-4.86-.514-6.67.887-1.79 2.647-2.91 4.601-3.01 1.651-.09 3.368.56 4.798 2.01 1.429-1.45 3.146-2.1 4.796-2.01 1.954.1 3.714 1.22 4.601 3.01.896 1.81.846 4.17-.514 6.67z">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <span
                                                            class="ms-auto me-auto text-danger fw-bold like-count">{{ $umkm->likes->count() }}
                                                            likes</span>
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
                                                <p style="font-size: 14px;">
                                                    {{ $umkm->deskripsi }}</p>
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
                                            </div>
                                        </div>
                                        <!-- Products Section -->
                                        <div class="container">
                                            <div class="row">
                                                <div class="col mt-2 mb-4 pt-4 mx-4 rounded"
                                                    style="background-color: black">
                                                    <p class="h5 fw-bold text-white text-center" style="font-size: 18px">
                                                        <svg width="40" height="40" fill="currentColor"
                                                            class="bi bi-cart4 mb-3" viewBox="0 0 16 16">
                                                            <path
                                                                d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                                                        </svg> Menu Produk {{ $umkm->nama_umkm }}
                                                    </p>
                                                    <div class="row" style="max-height: 240px; overflow-y: auto;">
                                                        @foreach ($umkm->produk as $produk)
                                                            <div class="col-sm-3 mb-4">
                                                                <div>
                                                                    <img class="card-img img-fluid"
                                                                        style="object-fit: cover; height: 120px;"
                                                                        src="{{ asset('storage/produk_images/' . $produk->foto_produk) }}"
                                                                        alt="{{ $produk->nama_produk }}">
                                                                    <div class="rounded fw-bold text-white"
                                                                        style="background-color: rgb(158, 22, 22)">
                                                                        <p class="my-auto text-center my-2 pt-2 px-2 fw-semibold"
                                                                            style="font-size: 15px; max-height: 30px; overflow-y: auto">
                                                                            {{ $produk->nama_produk }}
                                                                        </p>
                                                                        <p class="my-auto text-center my-2 pb-2 px-2 fw-semibold"
                                                                            style="font-size: 14px">Rp
                                                                            {{ number_format($produk->harga, 0, ',', '.') }}
                                                                        </p>
                                                                        <div class="text-center like-container">
                                                                            <svg viewBox="0 0 16 16" aria-hidden="true"
                                                                                fill="white" width="25px"
                                                                                height="25px" style="cursor: pointer;"
                                                                                class="mb-2 bi bi-bag-heart like-btn {{ $produk->likes->where('user_id', auth()->id())->isNotEmpty() ? 'd-none' : '' }}"
                                                                                data-likeable-id="{{ $produk->id }}"
                                                                                data-likeable-type="produk">
                                                                                <g>
                                                                                    <path fill-rule="evenodd"
                                                                                        d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M14 14V5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1M8 7.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                                                                                </g>
                                                                            </svg>
                                                                            <svg viewBox="0 0 16 16" aria-hidden="true"
                                                                                fill="white" width="25px"
                                                                                height="25px" style="cursor: pointer;"
                                                                                class="mb-2 bi bi-bag-heart-fill-filled like-btn {{ $produk->likes->where('user_id', auth()->id())->isNotEmpty() ? '' : 'd-none' }}"
                                                                                data-likeable-id="{{ $produk->id }}"
                                                                                data-likeable-type="produk">
                                                                                <g>
                                                                                    <path
                                                                                        d="M11.5 4v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m0 6.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                                                                                </g>
                                                                            </svg>
                                                                            <span
                                                                                class="ms-auto me-auto text-white fw-bold like-count">{{ $produk->likes->count() }}
                                                                                likes</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
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
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Like UMKM -->
    <script>
        $(document).ready(function() {
            $('.like-icon, .like-icon-filled').on('click', function() {
                var $this = $(this);
                var likeableId = $this.data('likeable-id');
                var likeableType = $this.data('likeable-type');

                $.ajax({
                    url: '{{ route('like') }}',
                    method: 'POST',
                    data: {
                        likeable_id: likeableId,
                        likeable_type: likeableType,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Menghapus pesan notifikasi sebelum menambah yang baru
                        $this.closest('.col-6').find('.alert').remove();

                        if (response.status === 'liked') {
                            $this.closest('.like-container').find('.like-icon').addClass(
                                'd-none');
                            $this.closest('.like-container').find('.like-icon-filled')
                                .removeClass('d-none');
                        } else {
                            $this.closest('.like-container').find('.like-icon').removeClass(
                                'd-none');
                            $this.closest('.like-container').find('.like-icon-filled').addClass(
                                'd-none');
                        }
                        var likeCountElement = $this.closest('.like-container').find(
                            '.like-count');
                        likeCountElement.text(response.likes_count + ' likes');

                        // Menambahkan pesan notifikasi di atas form
                        var notificationHtml =
                            '<div class="alert alert-success" role="alert">' +
                            response.message + '</div>';
                        $this.closest('.col-6').prepend(notificationHtml);

                        // Menghapus pesan notifikasi setelah 5 detik
                        setTimeout(function() {
                            $this.closest('.col-6').find('.alert').fadeOut('slow',
                                function() {
                                    $(this).remove();
                                });
                        }, 5000); // 5000 ms = 5 detik

                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', error);
                    }
                });
            });
        });
    </script>
@endpush

<!-- Like Produk -->
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.bi-bag-heart, .bi-bag-heart-fill-filled').on('click', function() {
                var $this = $(this);
                var likeableId = $this.data('likeable-id');
                var likeableType = $this.data('likeable-type');

                $.ajax({
                    url: '{{ route('like') }}',
                    method: 'POST',
                    data: {
                        likeable_id: likeableId,
                        likeable_type: likeableType,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Remove previous notification
                        $this.closest('.like-container').find('.alert').remove();

                        if (response.status === 'liked') {
                            $this.closest('.like-container').find('.bi-bag-heart').addClass(
                                'd-none');
                            $this.closest('.like-container').find('.bi-bag-heart-fill-filled')
                                .removeClass('d-none');
                        } else {
                            $this.closest('.like-container').find('.bi-bag-heart').removeClass(
                                'd-none');
                            $this.closest('.like-container').find('.bi-bag-heart-fill-filled')
                                .addClass('d-none');
                        }
                        var likeCountElement = $this.closest('.like-container').find(
                            '.like-count');
                        likeCountElement.text(response.likes_count + ' likes');

                        // Add new notification
                        var notificationHtml =
                            '<div class="alert alert-success p-1" role="alert">' + response
                            .message + '</div>';
                        $this.closest('.like-container').prepend(notificationHtml);

                        // Remove notification after 5 seconds
                        setTimeout(function() {
                            $this.closest('.like-container').find('.alert').fadeOut(
                                'slow',
                                function() {
                                    $(this).remove();
                                });
                        }, 2000); // 2000 ms = 2 seconds

                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', error);
                    }
                });
            });
        });
    </script>
@endpush
