@extends('layouts.app')

@section('title', 'Administrasi')

@push('style')
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<style>
    .badge-status {
        display: inline-block;
        padding: 6px 20px;
        border-radius: 9999px;
        font-size: 14px;
        font-weight: 600;
    }

    .badge-proses {
        background-color: #c7d7fe;
        color: #3b82f6;
    }

    .badge-lulus {
        background-color: #bbf7d0;
        color: #22c55e;
    }

    .icon-button {
        width: 40px;
        height: 40px;
        background: #f1f5f9;
        border: none;
        display: inline-flex;
        /* Gunakan inline-flex untuk perataan di dalamnya */
        align-items: center;
        /* Ratakan item (ikon) secara vertikal di tengah tombol */
        justify-content: center;
        /* Ratakan item (ikon) secara horizontal di tengah tombol */
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        padding: 0;
        /* Reset padding agar perataan flex bekerja baik */
        margin: 0;
        /* Reset margin */
    }

    .icon-button i {
        font-size: 18px;
        color: #64748b;
    }

    .icon-button:hover {
        background: #e2e8f0;
    }

    .table thead th {
        background-color: #3c4b64;
        color: #ffffff !important;
        font-weight: bold;
        vertical-align: middle;
        /* Pastikan ini ada */
        text-align: center;
        /* Pertahankan jika Anda ingin teks header tetap di tengah */
    }

    .table thead th:first-child {
        text-align: left;
        /* Kembalikan teks "No" ke kiri */
    }

    .table tbody td {
        vertical-align: middle;
        /* Pastikan semua isi sel berada di tengah vertikal */
    }

    .table tbody td:nth-child(10),
    /* Kolom Dokumen */
    .table tbody td:nth-child(11) {
        /* Kolom Aksi */
        text-align: center;
        /* Pastikan konten di kolom ini tetap di tengah */
    }

    .table thead {
        background-color: #3c4b64;
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .main-content {
        margin-top: 30px;
    }

    .table-rounded {
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        overflow: hidden;
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

    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.2);
        /* Ubah nilai alpha (0.0 - 1.0) sesuai keinginan */
        background-color: transparent !important;
    }


    /* Styling untuk modal yang baru (revisi 3 - atur jarak internal) */
    .modal-dialog-centered {
        display: flex;
        align-items: center;
        min-height: calc(100% - (0.5rem * 2));
        width: auto;
        max-width: 90%;
        /* Ubah max-width menjadi persentase untuk layar kecil */
        margin: 0.5rem auto;
    }

    @media (min-width: 576px) {
        .modal-dialog-centered {
            min-height: calc(100% - (1.75rem * 2));
            max-width: 450px;
            /* Kembali ke ukuran tetap untuk layar yang lebih besar */
            margin: 1.75rem auto;
        }
    }

    .modal-content-custom {
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px 30px;
        /* Kurangi padding atas dan bawah */
        text-align: center;
    }

    .modal-icon {
        width: 80px;
        /* Sedikit kecilkan ikon lagi */
        height: 80px;
        border-radius: 50%;
        background-color: #ffe0b2;
        color: #f57c00;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 60px;
        /* Kecilkan font ikon */
        margin: 0 auto 15px;
        /* Kurangi margin bawah ikon */
    }

    .modal-title-custom {
        font-size: 25px;
        /* Kecilkan ukuran judul */
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
        /* Kurangi margin bawah judul */
    }

    .modal-message-custom {
        color: #555;
        margin-bottom: 0px;
        /* Kurangi margin bawah pesan */
        font-size: 15px;
        /* Kecilkan ukuran pesan */
    }

    .modal-buttons-custom {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 0px;
        /* Kurangi margin atas tombol */
        flex-direction: row-reverse;
    }

    .btn-primary-custom {
        background-color: #1758B9;
        /* Warna biru tombol Terima */
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-secondary-custom {
        background-color: #EB2027;
        /* Warna merah tombol Batal */
        color: #fff;
        /* Ubah warna teks menjadi putih agar terlihat jelas di atas latar merah */
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-primary-custom:hover {
        background-color: #134a96;
        /* Warna biru lebih gelap saat hover */
    }

    .btn-secondary-custom:hover {
        background-color: #b8181e;
        /* Warna merah lebih gelap saat hover */
        color: #fff;
    }

    .dropdown {
        display: inline-block;
        /* Pastikan dropdown tidak mengambil baris penuh */
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Administrasi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Administrasi</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')

            <div class="row mb-4 align-items-center">
                <div class="col-md-2 d-flex align-items-center">
                    <label class="mr-2 mb-0">Show</label>
                    <select class="form-control form-control-sm" style="width: 80px;">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    <label class="ml-2 mb-0">entries</label>
                </div>

                <div class="col-md-8">
                    <form action="{{ route('administrasi.index') }}" method="GET">
                        <div class="position-relative">
                            <span class="position-absolute" style="top: 50%; left: 15px; transform: translateY(-50%); color: #aaa;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="judul" value="{{ request('judul') }}"
                                class="form-control pl-5 shadow-sm"
                                placeholder="Search Judul..." style="height: 45px;">
                        </div>
                    </form>
                </div>

                <div class="col-md-2">
                    <form action="{{ route('administrasi.index') }}" method="GET">
                        <select name="status" class="form-control form-control-sm shadow-sm" style="height: 45px;" onchange="this.form.submit()">
                            <option value="">Filter</option>
                            <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-rounded">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No. Telephone</th>
                            <th>Posisi</th>
                            <th>Asal Institusi</th>
                            <th>Periode</th>
                            <th>Status</th>
                            <th>Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($administrasi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama->name }}</td>
                            <td>{{ $item->nama->email }}</td>
                            <td>{{ $item->nama->phone }}</td>
                            <td>{{ $item->nama->posisi->nama }}</td>
                            <td>{{ $item->nama->instansi->name }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->periode->tanggal_pegajuan)->translatedFormat('d M Y') }} -
                                {{ \Carbon\Carbon::parse($item->periode->tanggal_selesai)->translatedFormat('d M Y') }}
                            </td>
                            <td>
                                @if($item->status == 'proses')
                                <span class="badge-status badge-proses">Proses</span>
                                @elseif($item->status == 'lulus')
                                <span class="badge-status badge-lulus">Lulus</span>
                                @elseif($item->status == 'ditolak')
                                <span class="badge-status badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="icon-button dropdown-toggle" type="button" id="aksiDropdown{{ $item->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-file-alt"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="aksiDropdown{{ $item->id }}">
                                        <a class="dropdown-item" href="#"><i class="fas fa-file-alt"></i> Surat</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-file-alt"></i> CV</a>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="icon-button dropdown-toggle" type="button" id="aksiDropdown{{ $item->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-justify"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown{{ $item->id }}">
                                        <button type="button" class="dropdown-item terima-btn" data-toggle="modal" data-target="#terimaModal" data-id="{{ $item->id }}">
                                            <i class="fas fa-check text-success mr-2"></i> Terima
                                        </button>
                                        <button type="button" class="dropdown-item tolak-btn" data-toggle="modal" data-target="#tolakModal" data-id="{{ $item->id }}">
                                            <i class="fas fa-times text-danger mr-2"></i> Tolak
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="float-right mt-3">
                {{ $administrasi->withQueryString()->links() }}
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="terimaModal" tabindex="-1" role="dialog" aria-labelledby="terimaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon">
                !
            </div>
            <h5 class="modal-title modal-title-custom" id="terimaModalLabel">Terima Pendaftar?</h5>
            <div class="modal-body modal-message-custom">
                Apakah Anda yakin ingin menerima pendaftar ini?
                <form id="terimaForm" method="POST" action="{{ route('administrasi.terima') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="administrasi_id" id="terima_administrasi_id">
                </form>
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-secondary btn-secondary-custom" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-primary-custom" form="terimaForm">Terima</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon">
                !
            </div>
            <h5 class="modal-title modal-title-custom" id="tolakModalLabel">Tolak Pendaftar?</h5>
            <div class="modal-body modal-message-custom">
                Apakah Anda yakin ingin menolak pendaftar ini?
                <form id="tolakForm" method="POST" action="{{ route('administrasi.tolak') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="administrasi_id" id="tolak_administrasi_id">
                </form>
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-secondary btn-secondary-custom" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger" form="tolakForm">Tolak</button>
            </div>
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
    $(document).ready(function() {
        $('.unggah-wawancara-btn').on('click', function() {
            var id = $(this).data('id');
            $('#unggah_wawancara_id').val(id);
            $('#unggahWawancaraModal').modal('show');
            // Simpan elemen yang aktif sebelum modal dibuka
            $(document).data('activeElementBeforeModal', $(document.activeElement));
        });

        $('#unggahWawancaraModal').on('hidden.bs.modal', function(e) {
            $('#unggah_wawancara_id').val('');
            $('#unggahWawancaraForm')[0].reset();
            $('.modal-backdrop').remove();
            // Coba paksa reflow pada body
            document.body.classList.remove('modal-open');
            document.body.style.paddingRight = '';
        });

        $('#unggahWawancaraModal').on('shown.bs.modal', function() {
            $(this).find('#tanggal_awal_seleksi').focus();
        });

        $('.terima-btn').on('click', function() {
            var id = $(this).data('id');
            $('#terimaForm').attr('action', '/administrasi/' + id + '/terima');
            $('#terima_administrasi_id').val(id);
            $('#terimaModal').modal('show');
            $(document).data('activeElementBeforeModal', $(document.activeElement));
        });

        $('#terimaModal').on('hidden.bs.modal', function(e) {
            $('#terimaForm').attr('action', '');
            $('#terima_administrasi_id').val('');
            $('.modal-backdrop').remove();
            $(document).data('activeElementBeforeModal').focus();
        });

        $('#terimaModal').on('shown.bs.modal', function() {
            $(this).find('.btn-primary-custom').focus();
        });

        $('.tolak-btn').on('click', function() {
            var id = $(this).data('id');
            $('#tolakForm').attr('action', '/administrasi/' + id + '/tolak');
            $('#tolak_administrasi_id').val(id);
            $('#tolakModal').modal('show');
            $(document).data('activeElementBeforeModal', $(document.activeElement));
        });

        $('#tolakModal').on('hidden.bs.modal', function(e) {
            $('#tolakForm').attr('action', '');
            $('#tolak_administrasi_id').val('');
            $('.modal-backdrop').remove();
            $(document).data('activeElementBeforeModal').focus();
        });

        $('#tolakModal').on('shown.bs.modal', function() {
            $(this).find('.btn-danger').focus();
        });
    });
</script>
@endpush