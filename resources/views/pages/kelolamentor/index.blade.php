@extends('layouts.app')

@section('title', 'Kelola Mentor')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQmQa7TBcVRBuKjXo/w1QkguhIyyLK4yrQX0Yv5i7k/tVElnXoltgFNnMqEzlnJwjnDHkz1NW0xPEaBwvsuJVksPdodPIFnFgzomxhJlY9lGqlTgfgcwKSjy23z4lwh9+nHm0Pdu7Z35wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
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
    }

    .table thead {
        background-color: #3c4b64;
        color: white;
    }

    .table thead th {
        background-color: #3c4b64;
        color: #ffffff !important;
        font-weight: bold;
        vertical-align: middle;
        /* Tambahkan ini */
        text-align: center;
        /* Pastikan teks header tetap di tengah jika diinginkan */
    }

    .table thead th:first-child {
        text-align: left;
        /* Kembalikan teks "No" ke kiri */
    }

    .table tbody td {
        vertical-align: middle;
        /* Pastikan semua isi sel berada di tengah vertikal */
    }

    .table tbody td:last-child {
        text-align: center;
        /* Tengahkan konten di kolom "Aksi" */
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

    .dropdown {
        display: inline-block;
        /* Pastikan dropdown tidak mengambil baris penuh */
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

    .modal-tambah-mentor .modal-dialog-centered {
        max-width: 400px;
        /* Lebar modal tambah mentor */
    }

    .modal-tambah-mentor .modal-content {
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .modal-tambah-mentor .modal-header {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }

    .modal-tambah-mentor .modal-title {
        font-size: 18px;
        font-weight: bold;
        color: #333;
    }

    .modal-tambah-mentor .modal-body {
        padding: 15px 0;
    }

    .modal-tambah-mentor .form-group {
        margin-bottom: 15px;
    }

    .modal-tambah-mentor label {
        display: block;
        margin-bottom: 5px;
        color: #555;
        font-size: 14px;
    }

    .modal-tambah-mentor .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 15px;
    }

    .modal-tambah-mentor .modal-footer {
        border-top: 1px solid #dee2e6;
        padding-top: 15px;
        margin-top: 15px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .table thead th {
        background-color: #3c4b64;
        color: #ffffff !important;
        font-weight: bold;
        vertical-align: middle;
        /* Tambahkan ini */
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Kelola Mentor</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Kelola Mentor</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')

            <div class="row mb-4">
                <div class="col-md-12">
                    <button class="btn btn-primary" id="btnTambahMentor">
                        <i class="bi bi-plus-lg"></i> Tambah Mentor
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-rounded">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Posisi</th>
                            <th class="text-center">Total Mentee</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($mentors as $key => $mentor)
                        <tr>
                            <td class="align-middle">{{ $key + 1 }}</td>
                            <td class="align-middle">{{ $mentor['nama'] }}</td>
                            <td class="align-middle">{{ $mentor['email'] }}</td>
                            <td class="align-middle">{{ $mentor['posisi_mentor'] }}</td>
                            <td class="text-center align-middle">{{ $mentor['total_mentee'] }}</td>
                            <td class="text-center align-middle">
                                @if ($mentor['is_active'] === '1')
                                <span class="badge-status badge-active">AKTIF</span>
                                @else
                                <span class="badge-status badge-inactive">TIDAK AKTIF</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                <div class="dropdown">
                                    <button class="icon-button dropdown-toggle" type="button"
                                        id="aksiDropdownMentor{{ $mentor['id'] }}" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        aria-label="Tampilkan opsi aksi untuk mentor {{ $mentor['nama'] }}">
                                        <i class="fas fa-align-justify"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdownMentor{{ $mentor['id'] }}">
                                        @if ($mentor['status'] === 'tidak aktif')
                                        <a class="dropdown-item btn-aktif-nonaktif" href="#" data-id="{{ $mentor['id'] }}" data-status="{{ $mentor['status'] }}"><i class="fas fa-toggle-on text-success mr-2"></i> Aktifkan</a>
                                        @else
                                        <a class="dropdown-item btn-aktif-nonaktif" href="#" data-id="{{ $mentor['id'] }}" data-status="{{ $mentor['status'] }}"><i class="fas fa-toggle-off text-secondary mr-2"></i> Nonaktifkan</a>
                                        @endif
                                        <a class="dropdown-item btn-hapus-akun" href="#" data-toggle="modal"
                                            data-target="#modalKonfirmasiHapus{{ $mentor['id'] }}"
                                            data-id="{{ $mentor['id'] }}" data-nama="{{ $mentor['nama'] }}"><i class="fas fa-trash text-danger mr-2"></i> Hapus</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-users text-info mr-2"></i> Lihat Mentee</a>
                                    </div>
                                </div>

                                {{-- Modal Konfirmasi Hapus --}}
                                <div class="modal fade" id="modalKonfirmasiHapus{{ $mentor['id'] }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalKonfirmasiHapusLabel{{ $mentor['id'] }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-custom">
                                            <div class="modal-icon bg-danger text-white">
                                                <i class="bi bi-trash"></i>
                                            </div>
                                            <h5 class="modal-title modal-title-custom" id="modalKonfirmasiHapusLabel{{ $mentor['id'] }}">Konfirmasi Hapus</h5>
                                            <div class="modal-body modal-message-custom">
                                                Apakah Anda yakin ingin menghapus akun mentor <strong><span id="namaMentorHapus{{ $mentor['id'] }}"></span></strong>?
                                                <form id="hapusFormMentor{{ $mentor['id'] }}" action="#" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- Isi action dengan route yang sesuai --}}
                                                </form>
                                            </div>
                                            <div class="modal-footer modal-buttons-custom">
                                                <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-secondary btn-secondary-custom" form="hapusFormMentor{{ $mentor['id'] }}">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Modal Tambah Mentor --}}
            <div class="modal fade modal-tambah-mentor" id="modalTambahMentor" tabindex="-1role=" dialog" aria-labelledby="modalTambahMentorLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahMentorLabel">Tambah Mentor Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="formTambahMentor" action="#" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="konfirmasi_password">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
                                </div>
                                <div class="form-group">
                                    <label for="posisi">Posisi</label>
                                    <select class="form-control" id="posisi" name="posisi">
                                        <option value="Programmer">Programmer</option>
                                        <option value="UI/UX Designer">UI/UX Designer</option>
                                        <option value="Data Scientist">Data Scientist</option>
                                        <option value="Project Manager">Project Manager</option>
                                        <option value="Business Analyst">Business Analyst</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" form="formTambahMentor">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Konfirmasi Aksi (Aktif/Nonaktif) --}}
            <div class="modal fade" id="modalKonfirmasiAksi" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiAksiLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-custom">
                        <div class="modal-icon bg-warning text-white">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h5 class="modal-title modal-title-custom" id="modalKonfirmasiAksiLabel">Konfirmasi Aksi</h5>
                        <div class="modal-body modal-message-custom">
                            Anda yakin ingin <span id="konfirmasiAksiContent"></span> mentor <strong><span id="namaMentorAksi"></span></strong>?
                        </div>
                        <div class="modal-footer modal-buttons-custom">
                            <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-secondary btn-secondary-custom" id="btnKonfirmasi">Lanjutkan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
        $('#modalTambahMentor').on('show.bs.modal', function(e) {
            $(this).find('form')[0].reset(); // Reset form ketika modal tambah ditampilkan
        });

        // Tampilkan modal tambah mentor tanpa backdrop statis
        $('#btnTambahMentor').on('click', function() {
            $('#modalTambahMentor').modal({
                backdrop: false // Mencegah backdrop statis
            });
        });

        $('.btn-aktif-nonaktif').on('click', function() {
            var id = $(this).data('id');
            var statusSaatIni = $(this).data('status');
            var nama = $(this).closest('tr').find('td:nth-child(2)').text();
            var statusBaru = statusSaatIni === 'aktif' ? 'tidak aktif' : 'aktif';
            var teksKonfirmasi = statusSaatIni === 'aktif' ? 'non-aktifkan' : 'aktifkan';

            $('#namaMentorAksi').text(nama);
            $('#konfirmasiAksiContent').html('Anda yakin ingin ' + teksKonfirmasi + ' mentor ini?');
            $('#btnKonfirmasi').data('action', 'ubah-status');
            $('#btnKonfirmasi').data('id', id);
            $('#btnKonfirmasi').data('status-baru', statusBaru);
            $('#modalKonfirmasiAksi').modal({ // Tampilkan modal konfirmasi tanpa backdrop statis
                backdrop: false
            });
        });

        $('.btn-hapus-akun').on('click', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');

            $('#namaMentorAksi').text(nama);
            $('#konfirmasiAksiContent').html('Anda yakin ingin menghapus akun mentor ini?');
            $('#btnKonfirmasi').data('action', 'hapus-akun');
            $('#btnKonfirmasi').data('id', id);
            $('#modalKonfirmasiAksi').modal({ // Tampilkan modal konfirmasi tanpa backdrop statis
                backdrop: false
            });
        });

        $('#btnKonfirmasi').on('click', function() {
            var action = $(this).data('action');
            var id = $(this).data('id');

            if (action === 'ubah-status') {
                var statusBaru = $(this).data('status-baru');
                // Lakukan AJAX request ke backend untuk mengubah status mentor
                alert('Aksi ubah status (ID: ' + id + ') menjadi ' + statusBaru + ' akan diproses di backend.');
                // Contoh AJAX menggunakan fetch:
                /*
                fetch('/api/mentor/' + id + '/status', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Jika menggunakan CSRF
                    },
                    body: JSON.stringify({ status: statusBaru })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Lakukan pembaruan tampilan jika berhasil
                        location.reload(); // Contoh: reload halaman
                    } else {
                        alert('Gagal mengubah status.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan.');
                });
                */
            } else if (action === 'hapus-akun') {
                // Lakukan AJAX request ke backend untuk menghapus akun mentor
                alert('Aksi hapus akun (ID: ' + id + ') akan diproses di backend.');
                // Contoh AJAX menggunakan fetch:
                /*
                fetch('/api/mentor/' + id, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Jika menggunakan CSRF
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Lakukan pembaruan tampilan jika berhasil
                        location.reload(); // Contoh: reload halaman
                    } else {
                        alert('Gagal menghapus akun.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan.');
                });
                */
            }
            $('#modalKonfirmasiAksi').modal('hide');
        });

        $('#formTambahMentor').on('submit', function(e) {
            e.preventDefault();
            // Lakukan AJAX request ke backend untuk menyimpan data mentor baru
            var formData = $(this).serialize();
            alert('Data mentor baru akan dikirim ke backend: ' + formData);
            // Contoh AJAX menggunakan fetch:
            /*
            fetch('/api/mentor', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Jika menggunakan CSRF
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $('#modalTambahMentor').modal('hide');
                    location.reload(); // Contoh: reload halaman
                } else {
                    alert('Gagal menambahkan mentor.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan.');
            });
            */
        });

        // Set nama mentor pada modal konfirmasi hapus saat ditampilkan
        $('#modalKonfirmasiHapus').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var nama = button.data('nama'); // Ekstrak info dari atribut data-*
            var mentorId = button.data('id');
            var modal = $(this);
            modal.find('#namaMentorHapus' + mentorId).text(nama);
            modal.find('#hapusFormMentor' + mentorId).attr('action', '/admin/mentor/' + mentorId); // Sesuaikan dengan route Anda
        });
    });
</script>
@endpush