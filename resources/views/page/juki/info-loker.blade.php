@extends('layout.app')
@section('title', 'Info Loker')
@section('content')
    <!-- Info Loker Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="py-5" style="background-color: rgba(0, 0, 0, 0.9);">
                    <div class="grid mx-5 mt-4 mb-2">
                        <div class="row row-gap-3" id="lokerContainer">
                            @if ($lokers->isEmpty())
                                <p class="text-center text-white">Tidak ada Loker UMKM ditemukan di kota: <strong
                                        id="kotaUmkm">{{ $kota_umkm }}</strong>
                                </p>
                            @else
                                @foreach ($lokers as $loker)
                                    @if ($loker->nama_umkm && $loker->kota_umkm && $loker->lokasi_umkm && $loker->foto_umkm)
                                        <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                                            <a href="{{ route('detailLoker', $loker->id) }}" class="text-decoration-none">
                                                <div class="card w-100 h-100" style="background-color: rgb(243, 198, 240)">
                                                    <div class="card-body d-flex flex-column">
                                                        <div class="d-flex justify-content-between my-auto"
                                                            style="font-size: 18px">
                                                            <p class="card-title text-dark fw-bold my-auto">
                                                                {{ $loker->nama_umkm }}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-between flex-wrap my-2">
                                                            <div class="text-start mb-2 mb-md-1">
                                                                <p class="my-auto rounded bg-dark text-white py-1 px-2 fw-semibold"
                                                                    style="font-size: 14px">{{ $loker->kota_umkm }}</p>
                                                            </div>
                                                            <div class="text-end">
                                                                <a href="{{ $loker->lokasi_umkm }}"
                                                                    class="my-auto rounded py-1 bg-success px-2 fw-bold text-dark text-decoration-none"
                                                                    style="font-size: 14px">
                                                                    <svg width="17" height="17" fill="red"
                                                                        class="bi bi-geo-alt-fill mb-1" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                                                    </svg>
                                                                    <svg viewBox="0 0 24 24" aria-hidden="true"
                                                                        fill="black" weight="20px" height="20px">
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
                                                        <p
                                                            style="font-size: 14px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; margin: 10px auto;">
                                                            {{ $loker->kualifikasi }}
                                                        </p>
                                                        <div>
                                                            <a href="mailto:{{ $loker->user->email }}"
                                                                class="w-100 my-auto rounded py-1 btn btn-warning btn-block px-2 fw-bold text-primary text-decoration-none"
                                                                style="font-size: 14px">Kirim Email <svg class="mb-1"
                                                                    weight="17px" height="17px" fill="#007bff"
                                                                    class="bi bi-envelope" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M0 4.516V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.516l-8 5.333-8-5.333zm1-1L8 9.849 15 3V2H1v1.516z" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
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
            $('#searchLokerForm').on('submit', function(e) {
                e.preventDefault();

                let kotaUmkm = $('#kotaLoker').val();
                console.log('Kota UMKM:', kotaUmkm);

                $.ajax({
                    type: "GET",
                    url: "{{ route('searchLoker') }}",
                    data: {
                        kota_umkm: kotaUmkm
                    },
                    success: function(response) {
                        console.log('Response:', response);
                        $('#lokerContainer').empty();
                        if (response.lokers.length > 0) {
                            $.each(response.lokers, function(index, loker) {
                                console.log('Loker:', loker);
                                let lokerCard = `<div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                            <a href="{{ url('detailLoker') }}/${loker.id}" class="text-decoration-none">
                            <div class="card w-100 h-100" style="background-color: rgb(243, 198, 240)">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between my-auto"
                                        style="font-size: 18px">
                                        <p class="card-title text-dark fw-bold my-auto">${loker.nama_umkm}</p>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap my-2">
                                        <div class="text-start mb-2 mb-md-1">
                                            <p class="my-auto rounded bg-dark text-white py-1 px-2 fw-semibold"
                                                style="font-size: 14px">${loker.kota_umkm}</p>
                                        </div>
                                        <div class="text-end">
                                            <a href="${loker.lokasi_umkm}"
                                                class="my-auto rounded py-1 bg-success px-2 fw-bold text-dark text-decoration-none"
                                                style="font-size: 14px">
                                                <svg width="17" height="17" fill="red" class="bi bi-geo-alt-fill mb-1" viewBox="0 0 16 16">
                                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
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
                                        </div>
                                    </div>
                                    <p class="fw-bold text-start m-0"
                                        style="font-size: 14px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; margin: 10px auto;">
                                        ${loker.jumlah_loker} Posisi ${loker.posisi_loker}
                                    </p>
                                    <p
                                        style="font-size: 14px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; margin: 10px auto;">
                                        ${loker.kualifikasi}
                                    </p>
                                    <div>
                                        <a href="mailto:${loker.user_email}"
                                            class="w-100 my-auto rounded py-1 btn btn-warning btn-block px-2 fw-bold text-primary text-decoration-none"
                                            style="font-size: 14px">Kirim Email <svg class="mb-1"
                                                weight="17px" height="17px" fill="#007bff"
                                                class="bi bi-envelope" viewBox="0 0 16 16">
                                                <path
                                                    d="M0 4.516V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.516l-8 5.333-8-5.333zm1-1L8 9.849 15 3V2H1v1.516z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>`;
                                $('#lokerContainer').append(lokerCard);
                            });
                        } else {
                            let message =
                                `<p class="text-center text-white">Tidak ada Loker UMKM ditemukan di kota: <strong>${response.kota_umkm}</strong></p>`;
                            $('#lokerContainer').append(message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
