@extends('layouts.app')

@section('title', 'Testimoni')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .badge-status {
            display: inline-block;
            padding: 6px 20px;
            border-radius: 9999px;
            font-size: 14px;
            font-weight: 600;
        }

        .badge-publish {
            background-color: #bbf7d0;
            color: #22c55e;
        }

        .badge-unpublish {
            background-color: #fce7f3;
            color: #db2777;
        }

        .icon-button {
            width: 30px; /* Ukuran lebih kecil */
            height: 30px; /* Ukuran lebih kecil */
            background: #f1f5f9;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px; /* Radius lebih kecil */
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            padding: 0;
            margin: 0; /* Reset margin */
            display: inline-flex; /* Gunakan inline-flex untuk perataan di dalamnya */
        align-items: center; /* Ratakan item (ikon) secara vertikal di tengah tombol */
        justify-content: center; /* Ratakan item (ikon) secara horizontal di tengah tombol */
        }

        .icon-button i {
            font-size: 16px; /* Ukuran ikon lebih kecil */
            color: #64748b;
        }

        .icon-button:hover {
            background: #e2e8f0;
        }

        .table thead th {
        background-color: #3c4b64;
        color: #ffffff !important;
        font-weight: bold;
        text-align: center; /* Pastikan teks "Detail" di tengah */
        padding-top: 12px;
        padding-bottom: 12px;
        border-bottom: none !important;
        border-right: none !important;
        vertical-align: middle; /* Pastikan perataan vertikal di header */
    }

    .table thead th:first-child {
        border-left: none !important;
        text-align: left; /* Kembalikan teks "No", "Nama", dll. ke kiri */
    }

    .table tbody td {
        padding-top: 10px;
        padding-bottom: 10px;
        vertical-align: middle; /* Pastikan perataan vertikal di body */
        border-bottom: 1px solid #f3f4f6;
        border-right: 1px solid #f3f4f6;
    }

    .table tbody td:last-child {
        text-align: center; /* Pastikan ikon mata di tengah */
    }

    .table tbody td:first-child {
        text-align: left; /* Kembalikan teks "No" ke kiri */
    }

        .table thead {
            background-color: #3c4b64;
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 5px; /* Jarak antar tombol lebih kecil */
            justify-content: center;
        }

        .main-content {
            margin-top: 30px;
            padding-left: 15px; /* Tambahkan padding kiri default Stisla jika dihilangkan */
            padding-right: 15px; /* Tambahkan padding kanan default Stisla jika dihilangkan */
        }

        .section-body {
            padding: 0; /* Hilangkan padding default section-body */
        }

        .table-responsive {
            border-radius: 12px; /* Tambahkan border-radius ke container responsive */
            overflow: hidden; /* Pastikan border-radius tabel tidak tertutup overflow */
            margin-bottom: 15px; /* Tambahkan margin bawah jika perlu */
        }

        .table-rounded {
            border-collapse: collapse !important; /* Ubah ke collapse agar border menyatu */
            width: 100%; /* Pastikan tabel mengambil lebar penuh parent */
            border: 1px solid #dee2e6; /* Tambahkan border keseluruhan untuk tampilan rounded */
        }

        .table-rounded thead th:first-child {
            border-top-left-radius: 12px;
        }

        .table-rounded thead th:last-child {
            border-top-right-radius: 12px;
        }

        .table-rounded tbody tr:last-child td:first-child {
            border-bottom-left-radius: 12px;
        }

        .table-rounded tbody tr:last-child td:last-child {
            border-bottom-right-radius: 12px;
        }

        .table-rounded th,
        .table-rounded td {
            padding: 10px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6; /* Tambahkan garis bawah antar baris */
            border-right: 1px solid #f3f4f6; /* Tambahkan garis kanan antar kolom */
        }

        .table-rounded th:last-child,
        .table-rounded td:last-child {
            border-right: none; /* Hilangkan border kanan pada kolom terakhir */
        }

        .table-rounded tbody tr:last-child td {
            border-bottom: none; /* Hilangkan garis bawah pada baris terakhir */
        }

        .dropdown-menu.show {
            background-color: #ffffff !important;
            border: none;
            border-radius: 12px !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
            padding: 10px 0 !important;
            min-width: 150px;
        }

        .dropdown-item {
            color: #334155 !important;
            font-weight: 500 !important;
            padding: 10px 20px !important;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-item:hover {
            background-color: #f1f5f9 !important;
            color: #1e293b !important;
        }

        .dropdown-toggle::after {
            display: none !important;
        }
        .modal-backdrop.show {
            opacity: 0 !important;
        }
        .modal { /* Target semua modal secara umum */
            z-index: 1050 !important;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="section-title">Testimoni</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Testimoni</div>
                </div>
            </div>

            <div class="section-body">
                @include('layouts.alert')

                <div class="row mb-4">
                    <div class="col-md-12">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahTestimoniModal">
                            <i class="bi bi-plus-lg"></i> Tambah Testimoni
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-rounded">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Instansi</th>
                            <th>Posisi</th>
                            <th class="text-center align-middle-header">Detail</th>
                        </tr>
                    </thead>
                        <tbody>
                            @php
                                $dummyTestimonials = [
                                    [
                                        'id' => 1,
                                        'nama' => 'MAULANA PRATAMA',
                                        'instansi' => 'SMK 12 Pekanbaru',
                                        'posisi' => 'Programmer',
                                        'testimoni' => 'Magang di PT Garuda Cyber Indonesia merupakan pengalaman yang sangat berharga bagi saya. Selama magang...',
                                    ],
                                    [
                                        'id' => 2,
                                        'nama' => 'AGUNG',
                                        'instansi' => 'Universitas Islam Riau',
                                        'posisi' => 'System Analyst',
                                        'testimoni' => 'Testimoni kedua dari Agung dengan pengalaman yang berbeda dan sangat positif...',
                                    ],
                                    // Tambahkan data testimoni lain di sini dengan data foto, instansi, dan posisi
                                ];
                            @endphp

                            @foreach ($dummyTestimonials as $key => $testimoni)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $testimoni['nama'] }}</td>
                                    <td>{{ $testimoni['instansi'] ?? '-' }}</td>
                                    <td>{{ $testimoni['posisi'] ?? '-' }}</td>
                                    <td class="text-center">
                                        <button class="icon-button detail-btn-testimoni" data-toggle="modal" data-target="#detailTestimoniModal{{ $testimoni['id'] }}" data-nama="{{ $testimoni['nama'] }}" data-instansi="{{ $testimoni['instansi'] ?? '' }}" data-posisi="{{ $testimoni['posisi'] ?? '' }}" data-testimoni="{{ $testimoni['testimoni'] }}" aria-label="Lihat detail testimoni {{ $testimoni['nama'] }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="detailTestimoniModal{{ $testimoni['id'] }}" tabindex="-1" role="dialog" aria-labelledby="detailTestimoniModalLabel{{ $testimoni['id'] }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailTestimoniModalLabel{{ $testimoni['id'] }}">Detail Testimoni</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Nama:</strong> <span id="detail-nama-{{ $testimoni['id'] }}"></span></p>
                                                <p><strong>Instansi:</strong> <span id="detail-instansi-{{ $testimoni['id'] }}"></span></p>
                                                <p><strong>Posisi:</strong> <span id="detail-posisi-{{ $testimoni['id'] }}"></span></p>
                                                <p><strong>Testimoni:</strong> <span id="detail-testimoni-{{ $testimoni['id'] }}"></span></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Jika ada pagination --}}
                {{-- <div class="float-right mt-3">
                    {{ $testimonials->links() }}
                </div> --}}

            </div>
        </section>
    </div>

    <div class="modal fade" id="tambahTestimoniModal" tabindex="-1" role="dialog" aria-labelledby="tambahTestimoniModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahTestimoniModalLabel">Tambah Testimoni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('testimoni.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="instansi">Instansi</label>
                            <input type="text" class="form-control" id="instansi" name="instansi">
                        </div>
                        <div class="form-group">
                            <label for="posisi">Posisi</label>
                            <input type="text" class="form-control" id="posisi" name="posisi">
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <label for="testimoni">Testimoni</label>
                            <textarea class="form-control" id="testimoni" name="testimoni" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.detail-btn-testimoni').on('click', function () {
                var nama = $(this).data('nama');
                var instansi = $(this).data('instansi');
                var posisi = $(this).data('posisi');
                var testimoni = $(this).data('testimoni');
                var modalId = $(this).data('target');

                $(modalId).find('#detail-nama-' + $(this).data('target').split('Modal')[1]).text(nama);
                $(modalId).find('#detail-instansi-' + $(this).data('target').split('Modal')[1]).text(instansi);
                $(modalId).find('#detail-posisi-' + $(this).data('target').split('Modal')[1]).text(posisi);
                $(modalId).find('#detail-testimoni-' + $(this).data('target').split('Modal')[1]).text(testimoni);

                // Tampilkan modal detail testimoni TANPA backdrop statis
                $(modalId).modal({
                    backdrop: false
                });
            });
        });
    </script>
@endpush