@extends('layouts.app')

@section('title', 'Penilaian')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQmQa7TBcVRBuKjXo/w1QkguhIyyLK4yrQX0Yv5i7k/tVElnXoltgFNnMqEzlnJwjnDHkz1NW0xPEaBwvsuJVksPdodPIFnFgzomxhJlY9lGqlTgfgcwKSjy23z4lwh9+nHm0Pdu7Z35wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    /* CSS yang sama persis seperti sebelumnya */
    .badge-status {
        display: inline-block;
        padding: 6px 20px;
        border-radius: 9999px;
        font-size: 14px;
        font-weight: 600;
    }

    .badge-active {
        background-color: #bbf7d0;
        color: #22c55e;
    }

    .badge-inactive {
        background-color: #fce7f3;
        color: #db2777;
    }

    .icon-button {
        width: 40px;
        height: 40px;
        background: #f1f5f9;
        border: none;
        position: relative;
        /* Untuk menjadi containing block bagi ikon yang diposisikan absolute */
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        margin: 0 5px;
        display: inline-flex;
        /* Atau display: inline-block; jika tidak ingin flexbox mempengaruhi layout lain */
        align-items: center;
        justify-content: center;
    }

    .icon-button i {
        font-size: 18px;
        color: #64748b;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .icon-button:hover {
        background: #e2e8f0;
    }

    .table thead th {
        background-color: #3c4b64;
        color: #ffffff !important;
        font-weight: bold;
        text-align: left;
    }

    .table thead {
        background-color: #3c4b64;
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
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

    .align-middle {
        vertical-align: middle !important;
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
        background-color: transparent !important;
    }

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
        width: 100%;
        box-sizing: border-box;
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

    .modal-icon.bg-success {
        background-color: #c3e6cb !important;
        color: #155724 !important;
    }

    .modal-icon.bg-warning {
        background-color: #ffeeba !important;
        color: #85640a !important;
    }

    .modal-icon.bg-danger {
        background-color: #f8d7da !important;
        color: #721c24 !important;
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
        margin-top: 0px;
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
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Penilaian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Penilaian</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')

        </div>

        <div class="table-responsive">
            <table class="table table-striped table-rounded" id="tabel-penilaian"> {{-- Tambahkan ID untuk referensi JS --}}
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Posisi</th>
                        <th>Mentor</th>
                        <th class="text-center align-middle">Aksi</th>

                    </tr>
                </thead>
                <tbody>

                    @forelse ($penilaian as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        {{-- Cek jika relasi pengajuan dan user ada --}}
                        <td class="align-middle">
                            {{ optional(optional($item->pengajuan)->nama)->name ?? '-' }}
                        </td>

                        <td class="align-middle">
                            {{ optional(optional($item->pengajuan)->nama)->email ?? '-' }}
                        </td>

                        {{-- Cek jika posisi ada di user melalui pengajuan --}}
                        <td class="align-middle">
                            {{ optional(optional(optional($item->pengajuan)->nama)->posisi)->nama ?? '-' }}
                        </td>

                        {{-- Cek jika mentor ada --}}
                        <td class="align-middle">
                            {{ optional($item->mentor)->nama ?? '-' }}
                        </td>

                        <td class="text-center align-middle">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="aksiDropdownPenilaian{{ $item->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Aksi
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdownPenilaian{{ $item->id }}">
                                    <a href="{{ route('penilaian.edit', $item->id) }}" class="dropdown-item">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('penilaian.show', $item->id) }}" class="dropdown-item">
                                        <i class="bi bi-eye-fill"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </td>
        </div>
        </td>
        </tr>

        {{-- Modal Delete Konfirmasi untuk Penilaian --}}
        <div class="modal fade" id="deleteModalPenilaian{{ $item['id'] }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalPenilaianLabel{{ $item['id'] }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-custom">
                    <div class="modal-icon bg-danger text-white">
                        <i class="bi bi-trash"></i>
                    </div>
                    <h5 class="modal-title modal-title-custom" id="deleteModalPenilaianLabel{{ $item['id'] }}">Konfirmasi Hapus Penilaian</h5>
                    <div class="modal-body modal-message-custom">
                        Apakah Anda yakin ingin menghapus penilaian atas nama <strong><span id="namaPenilaianDelete{{ $item['id'] }}">{{ $item->pengajuan?->user?->name }}</span></strong>? {{-- Perbaikan di sini --}}
                        <form id="deleteFormPenilaian{{ $item['id'] }}" action="{{ route('penilaian.destroy', $item['id']) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                    <div class="modal-footer modal-buttons-custom">
                        <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-secondary btn-secondary-custom" form="deleteFormPenilaian{{ $item['id'] }}">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <tr>
            <td colspan="6" class="text-center">Tidak ada data penilaian.</td>
        </tr>
        @endforelse
        </tbody>
        </table>
</div>

{{-- Jika ada pagination --}}
{{-- <div class="float-right mt-3">
                {{ $penilaian->links() }}
</div> --}}

</div>
</section>
</div>

{{-- Modal Tambah Penilaian --}}
<div class="modal fade" id="tambahPenilaianModal" tabindex="-1" role="dialog" aria-labelledby="tambahPenilaianModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPenilaianModalLabel">Tambah Penilaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambahPenilaian" action="{{ route('penilaian.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="pengajuan_id">Pengajuan</label>
                        {{-- Anda perlu menyediakan daftar pengajuan di sini, mungkin dari variabel yang dilewatkan dari controller --}}
                        <select class="form-control" id="pengajuan_id" name="pengajuan_id" required>
                            <option value="">Pilih Pengajuan</option>
                            {{-- Contoh: loop melalui pengajuan yang tersedia --}}
                            {{-- @foreach($pengajuans as $pengajuan)
                                <option value="{{ $pengajuan->id }}">{{ $pengajuan->user->name }} - {{ $pengajuan->posisi }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mentor_id">Mentor</label>
                        {{-- Anda perlu menyediakan daftar mentor di sini, mungkin dari variabel yang dilewatkan dari controller --}}
                        <select class="form-control" id="mentor_id" name="mentor_id" required>
                            <option value="">Pilih Mentor</option>
                            {{-- Contoh: loop melalui mentors yang tersedia --}}
                            {{-- @foreach($mentors as $mentor)
                                <option value="{{ $mentor->id }}">{{ $mentor->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="evaluation_name">Nama Evaluasi</label>
                        <input type="text" class="form-control" id="evaluation_name" name="evaluation_name" required>
                    </div>
                    <div class="form-group">
                        <label for="evaluation_type">Tipe Evaluasi</label>
                        <input type="text" class="form-control" id="evaluation_type" name="evaluation_type" required>
                    </div>
                    <div class="form-group">
                        <label for="value">Nilai</label>
                        <input type="number" class="form-control" id="value" name="value" required>
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

</script>
@endpush