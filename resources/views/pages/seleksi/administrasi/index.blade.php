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

    .badge-diterima {
        /* Disesuaikan dengan nilai di DB */
        background-color: #bbf7d0;
        color: #22c55e;
    }

    .badge-ditolak {
        /* Disesuaikan dengan nilai di DB dan CSS */
        background-color: #fecaca;
        color: #ef4444;
    }

    .icon-button {
        width: 40px;
        height: 40px;
        background: #f1f5f9;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        padding: 0;
        margin: 0;
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
        text-align: center;
    }

    .table thead th:first-child {
        text-align: left;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .table tbody td:nth-child(9),
    /* Kolom Dokumen */
    .table tbody td:nth-child(10) {
        /* Kolom Aksi */
        text-align: center;
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
        /* Sesuaikan jika modal backdrop Anda menjadi transparan atau ada masalah */
        background-color: rgba(0, 0, 0, 0.2);
    }

    /* Styling untuk modal (revisi 3 - atur jarak internal) */
    .modal-dialog-centered {
        display: flex;
        align-items: center;
        min-height: calc(100% - (0.5rem * 2));
        width: auto;
        max-width: 90%;
        margin: 0.5rem auto;
    }

    @media (min-width: 576px) {
        .modal-dialog-centered {
            min-height: calc(100% - (1.75rem * 2));
            max-width: 450px;
            margin: 1.75rem auto;
        }
    }

    .modal-content-custom {
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px 30px;
        text-align: center;
    }

    .modal-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #ffe0b2;
        color: #f57c00;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 60px;
        margin: 0 auto 15px;
    }

    .modal-title-custom {
        font-size: 25px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .modal-message-custom {
        color: #555;
        margin-bottom: 0px;
        font-size: 15px;
    }

    .modal-buttons-custom {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
        /* Kembali ke margin yang lebih standar */
        flex-direction: row-reverse;
    }

    .btn-primary-custom {
        background-color: #1758B9;
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
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-primary-custom:hover {
        background-color: #134a96;
    }

    .btn-secondary-custom:hover {
        background-color: #b8181e;
        color: #fff;
    }

    .dropdown {
        display: inline-block;
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
            @include('layouts.alert') {{-- Pastikan alert include berfungsi --}}

            <div class="row mb-4 align-items-center">
                <div class="col-md-2 d-flex align-items-center">
                    {{-- Ini adalah placeholder untuk Show X entries, belum fungsional --}}
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
                    {{-- Form Pencarian --}}
                    <form action="{{ route('administrasi.index') }}" method="GET">
                        <div class="position-relative">
                            <span class="position-absolute" style="top: 50%; left: 15px; transform: translateY(-50%); color: #aaa;">
                                <i class="fas fa-search"></i>
                            </span>
                            {{-- Ubah name dari 'judul' menjadi 'search' agar lebih generik --}}
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="form-control pl-5 shadow-sm"
                                placeholder="Search Nama Pendaftar..." style="height: 45px;">
                        </div>
                    </form>
                </div>

                <div class="col-md-2">
                    {{-- Form Filter Status --}}
                    <form action="{{ route('administrasi.index') }}" method="GET">
                        <select name="status" class="form-control form-control-sm shadow-sm" style="height: 45px;" onchange="this.form.submit()">
                            <option value="">Semua</option> {{-- Ganti Filter menjadi Filter Status --}}
                            <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                            {{-- Sesuaikan value dan text dengan status di DB ('diterima', 'ditolak') --}}
                            <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
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
                        @forelse ($administrasi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama->name }}</td>
                            <td>{{ $item->nama->email }}</td>
                            <td>{{ $item->nama->phone }}</td>
                            <td>{{ $item->nama->posisi->nama }}</td> {{-- Asumsi $item->posisi adalah relasi --}}
                            <td>{{ $item->nama->instansi->nama }}</td> {{-- Asumsi $item->instansi adalah relasi --}}
                            <td>
                                {{ \Carbon\Carbon::parse($item->periode->tanggal_pegajuan)->translatedFormat('d M Y') }} -
                                {{ \Carbon\Carbon::parse($item->periode->tanggal_selesai)->translatedFormat('d M Y') }}
                            </td>
                            <td>
                                {{-- Menampilkan badge berdasarkan status_administrasi dari database --}}
                                @if($item->status_administrasi == 'proses')
                                <span class="badge-status badge-proses">Proses</span>
                                @elseif($item->status_administrasi == 'diterima')
                                <span class="badge-status badge-diterima">Diterima</span>
                                @elseif($item->status_administrasi == 'ditolak')
                                <span class="badge-status badge-ditolak">Ditolak</span>
                                @else
                                <span class="badge-status badge-secondary">Tidak Diketahui</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="icon-button dropdown-toggle" type="button" id="dokumenDropdown{{ $item->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-file-alt"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dokumenDropdown{{ $item->id }}">
                                        {{-- Pastikan ini mengarah ke route yang benar untuk dokumen --}}
                                        <a class="dropdown-item" href="#" target="_blank"><i class="fas fa-file-alt"></i> Lihat Dokumen</a>
                                        {{-- Tambahkan link untuk CV jika ada --}}
                                        {{-- <a class="dropdown-item" href="#" target="_blank"><i class="fas fa-file-alt"></i> CV</a> --}}
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="icon-button dropdown-toggle" type="button" id="aksiDropdown{{ $item->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-justify"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdown{{ $item->id }}">
                                        {{-- Tombol ini MEMBUKA MODAL dan meneruskan ID --}}
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
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data administrasi yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="float-right mt-3">
                {{ $administrasi->withQueryString()->links() }}
            </div>
        </div>
    </section>
</div>

{{-- MODAL TERIMA --}}
<div class="modal fade" id="terimaModal" tabindex="-1" role="dialog" aria-labelledby="terimaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon">
                !
            </div>
            <h5 class="modal-title modal-title-custom" id="terimaModalLabel">Terima Pendaftar?</h5>
            <div class="modal-body modal-message-custom">
                Apakah Anda yakin ingin menerima pendaftar ini?
                {{-- Hapus form, karena akan di-handle AJAX via JS --}}
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-secondary btn-secondary-custom" data-dismiss="modal">Batal</button>
                {{-- Ganti type="submit" menjadi "button" dan tambahkan ID untuk handler JS --}}
                <button type="button" class="btn btn-primary btn-primary-custom" id="confirmTerimaBtn">Terima</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TOLAK --}}
<div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-custom">
            <div class="modal-icon">
                !
            </div>
            <h5 class="modal-title modal-title-custom" id="tolakModalLabel">Tolak Pendaftar?</h5>
            <div class="modal-body modal-message-custom">
                Apakah Anda yakin ingin menolak pendaftar ini?
                {{-- Hapus form, karena akan di-handle AJAX via JS --}}
            </div>
            <div class="modal-footer modal-buttons-custom">
                <button type="button" class="btn btn-secondary btn-secondary-custom" data-dismiss="modal">Batal</button>
                {{-- Ganti type="submit" menjadi "button" dan tambahkan ID untuk handler JS --}}
                <button type="button" class="btn btn-danger" id="confirmTolakBtn">Tolak</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Pastikan semua library ini dimuat dengan benar --}}
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
        var currentPengajuanId; // Variabel untuk menyimpan ID pendaftar yang akan diproses

        // --- Handling Unggah Wawancara (jika masih diperlukan) ---
        // Kode ini dibiarkan sesuai aslinya jika Anda menggunakannya di bagian lain.
        // Pastikan modal #unggahWawancaraModal dan elemen terkaitnya ada.
        $('.unggah-wawancara-btn').on('click', function() {
            var id = $(this).data('id');
            $('#unggah_wawancara_id').val(id);
            $('#unggahWawancaraModal').modal('show');
        });

        $('#unggahWawancaraModal').on('hidden.bs.modal', function(e) {
            $('#unggah_wawancara_id').val('');
            if ($('#unggahWawancaraForm').length) { // Cek formnya ada
                $('#unggahWawancaraForm')[0].reset();
            }
            // Hapus baris ini jika Bootstrap 4 sudah menangani backdrop dengan baik
            // $('.modal-backdrop').remove();
            document.body.classList.remove('modal-open');
            document.body.style.paddingRight = '';
        });

        $('#unggahWawancaraModal').on('shown.bs.modal', function() {
            $(this).find('#tanggal_awal_seleksi').focus();
        });

        // --- Handling Terima Pendaftar ---
        // Ketika tombol 'Terima' di dropdown diklik (memicu modal)
        $('.terima-btn').on('click', function() {
            currentPengajuanId = $(this).data('id'); // Ambil ID dari data-id tombol dropdown
            $('#terimaModal').modal('show'); // Tampilkan modal
        });

        // Ketika tombol 'Terima' di DALAM MODAL diklik
        $('#confirmTerimaBtn').on('click', function() {
            if (currentPengajuanId) {
                updateStatus(currentPengajuanId, 'terima'); // Panggil fungsi updateStatus
                // Modal akan otomatis tertutup jika respons sukses atau ada kesalahan
                // dan location.reload() akan memuat ulang halaman.
            } else {
                alert('ID pendaftar tidak ditemukan.');
            }
        });

        // --- Handling Tolak Pendaftar ---
        // Ketika tombol 'Tolak' di dropdown diklik (memicu modal)
        $('.tolak-btn').on('click', function() {
            currentPengajuanId = $(this).data('id'); // Ambil ID dari data-id tombol dropdown
            $('#tolakModal').modal('show'); // Tampilkan modal
        });

        // Ketika tombol 'Tolak' di DALAM MODAL diklik
        $('#confirmTolakBtn').on('click', function() {
            if (currentPengajuanId) {
                updateStatus(currentPengajuanId, 'tolak'); // Panggil fungsi updateStatus
                // Modal akan otomatis tertutup jika respons sukses atau ada kesalahan
                // dan location.reload() akan memuat ulang halaman.
            } else {
                alert('ID pendaftar tidak ditemukan.');
            }
        });

        // --- Fungsi AJAX untuk Update Status ---
        function updateStatus(itemId, actionType) {
            var url = '';
            var statusToSet = '';

            if (actionType === 'terima') {
                url = `{{ route('administrasi.terima') }}`; // Gunakan backticks
                statusToSet = 'diterima';
            } else if (actionType === 'tolak') {
                url = `{{ route('administrasi.tolak') }}`; // Gunakan backticks
                statusToSet = 'ditolak';
            } else {
                alert('Tipe aksi tidak valid.');
                return;
            }

            $.ajax({
                url: url,
                type: 'POST', // Tetap POST karena browser hanya bisa POST/GET natively
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'POST', // <--- TAMBAHKAN INI
                    id: itemId
                },
                success: function(response) {
                    // ...
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan saat menghubungi server: ' + xhr.responseText);
                    console.error(xhr.responseText);
                }
            });
        }

        // --- Reset currentPengajuanId saat modal disembunyikan (opsional tapi disarankan) ---
        $('#terimaModal, #tolakModal').on('hidden.bs.modal', function(e) {
            currentPengajuanId = null; // Reset ID agar tidak terpakai lagi
            // Jika Anda punya logic fokus elemen sebelumnya, bisa tambahkan di sini
        });
    });
</script>
@endpush