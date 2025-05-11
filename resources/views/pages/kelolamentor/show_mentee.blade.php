@extends('layouts.app')

{{-- Judul Halaman --}}
@section('title', 'Detail Mentor - Daftar Mentee')

{{-- Style CSS Tambahan --}}
@push('style')
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQmQa7TBcVRBuKjXo/w1QkguhIyyLK4yrQX0Yv5i7k/tVElnXoltgFNnMqEzlnJwjnDHkz1NW0xPEaBwvsuJVksPdodPIFnFgzomxhJlY9lGqlTgfgcwKSjy23z4lwh9+nHm0Pdu7Z35wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Select2 CSS (Optional, for better dropdown search) --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Gaya umum */
        .badge-status {
            display: inline-block;
            padding: 6px 20px;
            border-radius: 9999px;
            font-size: 14px;
            font-weight: 600;
        }
        .badge-active { background-color: #bbf7d0; color: #22c55e; }
        .badge-inactive { background-color: #fce7f3; color: #db2777; }
        .icon-button {
            width: 40px;
            height: 40px;
            background: #f1f5f9;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }
        .icon-button i { font-size: 18px; color: #64748b; }
        .icon-button:hover { background: #e2e8f0; }
        .table thead th {
            background-color: #3c4b64;
            color: #ffffff !important;
            font-weight: bold;
            vertical-align: middle;
        }
        .table thead { background-color: #3c4b64; color: white; }
        .action-buttons { display: flex; gap: 10px; justify-content: center; }
        .main-content { margin-top: 30px; }
        .table-rounded {
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid #dee2e6;
            border-radius: 12px;
            overflow: hidden;
        }
        .table-rounded thead th:first-child { border-top-left-radius: 12px; }
        .table-rounded thead th:last-child { border-top-right-radius: 12px; }
        .table-rounded tbody tr:last-child td:first-child { border-bottom-left-radius: 12px; }
        .table-rounded tbody tr:last-child td:last-child { border-bottom-right-radius: 12px; }
        .dropdown-menu.show {
            background-color: #ffffff !important;
            border: none;
            border-radius: 12px !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
            padding: 10px 0 !important;
            min-width: 100px; /* Adjusted width */
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
        .dropdown-item:hover { background-color: #f1f5f9 !important; color: #1e293b !important; }
        .dropdown-toggle::after { display: none !important; }

        /* Styles for non-blocking modals */
        .modal.fade:not(.show) { display: none; /* Hide when not shown */ }
        .modal.fade.show {
            display: block; /* Show when active */
            background-color: transparent !important; /* Make backdrop transparent */
            pointer-events: none; /* Allow clicks through the 'backdrop' area */
        }
        .modal-dialog { pointer-events: auto; /* Re-enable pointer events for the dialog itself */ }
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
                max-width: 450px; /* Default max width */
                margin: 1.75rem auto;
            }
        }

        /* Custom Modal Content Styling (Konfirmasi Hapus) */
        .modal-content-custom {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
            background-color: white; /* Ensure content has background */
        }
        .modal-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 30px;
            margin: 0 auto 15px;
        }
        .modal-icon.bg-danger { background-color: #f8d7da !important; color: #721c24 !important; }
        .modal-title-custom { font-size: 22px; font-weight: bold; color: #333; margin-bottom: 10px; }
        .modal-message-custom { color: #555; margin-bottom: 20px; font-size: 15px; }
        .modal-buttons-custom {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
            flex-direction: row; /* Adjusted */
        }
        .btn-primary-custom, .btn-secondary-custom {
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }
        .btn-primary-custom { background-color: #6c757d; color: #fff; } /* Secondary/Cancel color */
        .btn-secondary-custom { background-color: #dc3545; color: #fff; } /* Danger/Confirm color */
        .btn-primary-custom:hover { background-color: #5a6268; }
        .btn-secondary-custom:hover { background-color: #c82333; color: #fff; }

        /* Modal Tambah Mentee Styling */
        .modal-tambah-mentee .modal-dialog-centered { max-width: 400px; }
        .modal-tambah-mentee .modal-content {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: white; /* Ensure content has background */
        }
        .modal-tambah-mentee .modal-header {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-tambah-mentee .modal-title { font-size: 18px; font-weight: bold; color: #333; margin: 0; }
        .modal-tambah-mentee .modal-body { padding: 15px 0; }
        .modal-tambah-mentee .form-group { margin-bottom: 15px; }
        .modal-tambah-mentee label { display: block; margin-bottom: 5px; color: #555; font-size: 14px; }
        .modal-tambah-mentee .form-control, .modal-tambah-mentee .select2-container { width: 100% !important; } /* Ensure select2 takes full width */
        .modal-tambah-mentee .form-control {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 15px;
        }
        .modal-tambah-mentee .modal-footer {
            border-top: 1px solid #dee2e6;
            padding-top: 15px;
            margin-top: 15px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        .modal-tambah-mentee .btn-secondary { background-color: #6c757d; border-color: #6c757d; } /* Standard Bootstrap secondary */
        .modal-tambah-mentee .btn-secondary:hover { background-color: #5a6268; border-color: #545b62; }
        .modal-tambah-mentee .btn-primary { background-color: #007bff; border-color: #007bff; } /* Standard Bootstrap primary */
        .modal-tambah-mentee .btn-primary:hover { background-color: #0069d9; border-color: #0062cc; }

        /* Align text in table */
        .table td, .table th { vertical-align: middle; }
        .text-center { text-align: center; }
        .mentor-info {
            margin-bottom: 20px;
            font-size: 1.1rem;
            color: #495057;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Mentor</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    {{-- Asumsi route untuk kembali ke daftar mentor adalah 'admin.mentor.index' --}}
                    <div class="breadcrumb-item"><a href="{{ route('admin.mentor.index') }}">Kelola Mentor</a></div>
                    <div class="breadcrumb-item">Detail Mentor</div>
                </div>
            </div>

            <div class="section-body">
                @include('layouts.alert') {{-- Include alert partial --}}

                {{-- Tampilkan Informasi Mentor (Ganti $mentor dengan variabel yang sesuai) --}}
                @if(isset($mentor))
                    <div class="mentor-info">
                        Menampilkan mentee untuk Mentor: <strong>{{ $mentor->nama ?? 'Nama Mentor Tidak Ditemukan' }}</strong>
                        ({{ $mentor->posisi ?? 'Posisi Tidak Diketahui' }})
                    </div>
                @else
                    <div class="alert alert-warning">Informasi mentor tidak tersedia.</div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-12">
                        {{-- Tombol Tambah Mentee --}}
                        <button class="btn btn-primary" id="btnTambahMentee">
                            <i class="bi bi-plus-lg"></i> Tambah Mentee
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-rounded">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Institusi</th>
                                <th>Posisi</th>
                                <th>Periode</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Ganti $mentor->mentees dengan relasi/data mentee yang sesuai --}}
                            @php
                                // Data Dummy - Ganti dengan data asli dari $mentor->mentees atau variabel lain
                                $mentees = isset($mentor) ? $mentor->mentees : collect([
                                    (object)['id' => 1, 'nama' => 'Winda', 'institusi' => 'SMK 12 Pekanbaru', 'posisi' => 'Programmer', 'periode_mulai' => '2023-12-30', 'periode_selesai' => '2024-06-30'],
                                    (object)['id' => 2, 'nama' => 'Delima', 'institusi' => 'Universitas Islam Riau', 'posisi' => 'System Analyst', 'periode_mulai' => '2023-07-30', 'periode_selesai' => '2024-03-30'],
                                    (object)['id' => 3, 'nama' => 'Budi Santoso', 'institusi' => 'Politeknik Caltex Riau', 'posisi' => 'UI/UX Designer', 'periode_mulai' => '2024-01-15', 'periode_selesai' => '2024-07-15'],
                                ]);

                                // Data Dummy untuk dropdown tambah mentee (Ganti dengan user yang belum jadi mentee mentor ini)
                                $availableMentees = collect([
                                    (object)['id' => 4, 'nama' => 'Citra Lestari'],
                                    (object)['id' => 5, 'nama' => 'Doni Firmansyah'],
                                    (object)['id' => 6, 'nama' => 'Eka Putri'],
                                ]);
                            @endphp

                            @forelse ($mentees as $mentee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mentee->nama ?? 'N/A' }}</td>
                                    <td>{{ $mentee->institusi ?? 'N/A' }}</td>
                                    <td>{{ $mentee->posisi ?? 'N/A' }}</td>
                                    <td>
                                        {{ isset($mentee->periode_mulai) ? \Carbon\Carbon::parse($mentee->periode_mulai)->isoFormat('D MMM YYYY') : 'N/A' }}
                                        -
                                        {{ isset($mentee->periode_selesai) ? \Carbon\Carbon::parse($mentee->periode_selesai)->isoFormat('D MMM YYYY') : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        {{-- Tombol Aksi Hapus --}}
                                        <button class="icon-button btn-hapus-mentee"
                                                data-mentee-id="{{ $mentee->id }}"
                                                data-mentee-nama="{{ $mentee->nama ?? 'Mentee' }}"
                                                title="Hapus Mentee">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada mentee untuk mentor ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Modal Tambah Mentee --}}
                <div class="modal fade modal-tambah-mentee" id="modalTambahMentee" tabindex="-1" role="dialog" aria-labelledby="modalTambahMenteeLabel
                <div class="modal fade modal-tambah-mentee" id="modalTambahMentee" tabindex="-1" role="dialog" aria-labelledby="modalTambahMenteeLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTambahMenteeLabel">Tambah Mentee</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{-- Ganti '#' dengan route yang benar untuk menyimpan mentee baru --}}
                                <form id="formTambahMentee" action="{{ isset($mentor) ? route('admin.mentor.addMentee', $mentor->id) : '#' }}" method="POST">
                                    @csrf
                                    {{-- Hidden input untuk mentor_id jika diperlukan di backend --}}
                                    @if(isset($mentor))
                                        <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">
                                    @endif

                                    <div class="form-group">
                                        <label for="selectMentee">Nama Mentee</label>
                                        <select class="form-control" id="selectMentee" name="mentee_user_id" required style="width: 100%;">
                                            <option value="" disabled selected>Pilih Mentee</option>
                                            {{-- Loop data user yang bisa jadi mentee --}}
                                            @foreach ($availableMentees as $user)
                                                <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- Tambahkan field lain jika perlu (misal: Institusi, Posisi, Periode) --}}
                                    <div class="form-group">
                                        <label for="institusiMentee">Institusi</label>
                                        <input type="text" class="form-control" id="institusiMentee" name="institusi" placeholder="Contoh: SMK 1 Pekanbaru">
                                    </div>
                                    <div class="form-group">
                                        <label for="posisiMentee">Posisi</label>
                                        <select class="form-control" id="posisiMentee" name="posisi">
                                            <option value="">Pilih Posisi</option>
                                            <option value="Programmer">Programmer</option>
                                            <option value="UI/UX Designer">UI/UX Designer</option>
                                            <option value="Data Scientist">Data Scientist</option>
                                            <option value="System Analyst">System Analyst</option>
                                            <option value="Project Manager">Project Manager</option>
                                            <option value="Business Analyst">Business Analyst</option>
                                            {{-- Tambah opsi lain jika perlu --}}
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="periodeMulai">Periode Mulai</label>
                                        <input type="date" class="form-control" id="periodeMulai" name="periode_mulai">
                                    </div>
                                    <div class="form-group">
                                        <label for="periodeSelesai">Periode Selesai</label>
                                        <input type="date" class="form-control" id="periodeSelesai" name="periode_selesai">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" form="formTambahMentee">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Konfirmasi Hapus Mentee --}}
                <div class="modal fade" id="modalKonfirmasiHapusMentee" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiHapusLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content modal-content-custom">
                            <div class="modal-icon bg-danger">
                                <i class="fas fa-trash"></i>
                            </div>
                            <h5 class="modal-title modal-title-custom" id="modalKonfirmasiHapusLabel">Konfirmasi Hapus</h5>
                            <div class="modal-body modal-message-custom">
                                Apakah Anda yakin ingin menghapus mentee <strong id="namaMenteeHapus"></strong> dari mentor ini?
                            </div>
                            <div class="modal-footer modal-buttons-custom">
                                {{-- Form di submit via AJAX, action di set di JS --}}
                                <form id="hapusFormMentee" method="POST" action="#">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button type="button" class="btn btn-primary-custom" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-secondary-custom" id="btnKonfirmasiHapusMentee">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    {{-- Standard Stisla JS --}}
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.min.js') }}"></script> {{-- Popper.js for Bootstrap Tooltips/Dropdowns --}}
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
     <script src="{{ asset('library/moment/locale/id.js') }}"></script> {{-- Locale Indonesia untuk Moment.js --}}
    <script src="{{ asset('js/stisla.js') }}"></script>

    {{-- Select2 JS (Optional) --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Custom JS --}}
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        // Set locale moment.js ke Indonesia
        moment.locale('id');

        $(document).ready(function() {
            // Inisialisasi Select2 (jika digunakan)
            $('#selectMentee').select2({
                dropdownParent: $('#modalTambahMentee'), // Attach dropdown to modal
                placeholder: "Pilih Mentee",
                allowClear: true
            });

             // Reset form and Select2 when modal is shown
             $('#modalTambahMentee').on('show.bs.modal', function() {
                 $('#formTambahMentee')[0].reset(); // Reset form fields
                 $('#selectMentee').val(null).trigger('change'); // Reset Select2
             });

            // --- Modal Tambah Mentee ---
            $('#btnTambahMentee').on('click', function() {
                $('#modalTambahMentee').modal({
                    backdrop: false, // Important: No backdrop dimming
                    keyboard: true // Allow closing with Esc key
                });
                $('#modalTambahMentee').modal('show');
            });

            // --- Submit Form Tambah Mentee (Contoh AJAX) ---
            $('#formTambahMentee').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission
                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                // Tampilkan loading atau disable tombol submit
                form.find('button[type="submit"]').prop('disabled', true).text('Menyimpan...');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        $('#modalTambahMentee').modal('hide');
                        // Tampilkan notifikasi sukses (misal dengan SweetAlert atau library lain)
                        alert(response.message || 'Mentee berhasil ditambahkan!'); // Ganti dengan notifikasi yang lebih baik
                        location.reload(); // Reload halaman untuk melihat perubahan
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        var errorMessage = 'Gagal menambahkan mentee.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            try {
                                var jsonResponse = JSON.parse(xhr.responseText);
                                if (jsonResponse.message) {
                                    errorMessage = jsonResponse.message;
                                }
                            } catch(e) { console.error("Could not parse error response:", xhr.responseText); }
                        }
                        console.error('AJAX Error:', status, error, xhr.responseText);
                        alert(errorMessage); // Ganti dengan notifikasi error yang lebih baik
                        form.find('button[type="submit"]').prop('disabled', false).text('Simpan'); // Re-enable tombol
                    },
                    complete: function() {
                        form.find('button[type="submit"]').prop('disabled', false).text('Simpan'); // Pastikan tombol aktif kembali
                    }
                });
            });


            // --- Modal Konfirmasi Hapus Mentee ---
            // Event delegation for delete buttons
            $('.table-responsive').on('click', '.btn-hapus-mentee', function() {
                var menteeId = $(this).data('mentee-id');
                var menteeNama = $(this).data('mentee-nama');
                var mentorId = '{{ isset($mentor) ? $mentor->id : null }}'; // Ambil ID mentor

                 // Pastikan mentorId ada sebelum membuat URL
                 if (!mentorId) {
                     alert('Error: Mentor ID tidak ditemukan.');
                     return;
                 }

                // Ganti URL ini dengan route yang benar untuk menghapus relasi mentee dari mentor
                var deleteUrl = `/admin/mentor/${mentorId}/mentee/${menteeId}`; // Contoh URL (sesuaikan)

                $('#namaMenteeHapus').text(menteeNama); // Set nama di modal
                $('#hapusFormMentee').attr('action', deleteUrl); // Set action form

                $('#modalKonfirmasiHapusMentee').modal({
                    backdrop: false, // Important: No backdrop dimming
                    keyboard: true
                });
                 $('#modalKonfirmasiHapusMentee').modal('show');
            });

            // --- Konfirmasi Hapus Mentee via AJAX ---
            $('#btnKonfirmasiHapusMentee').on('click', function() {
                var form = $('#hapusFormMentee');
                var url = form.attr('action');
                var button = $(this);

                // Disable tombol saat proses
                button.prop('disabled', true).text('Menghapus...');

                $.ajax({
                    type: 'POST', // Method spoofing (DELETE) handled by @method('DELETE') in form
                    url: url,
                    data: form.serialize(), // Kirim CSRF token dan _method
                    success: function(response) {
                        $('#modalKonfirmasiHapusMentee').modal('hide');
                        // Tampilkan notifikasi sukses
                        alert(response.message || 'Mentee berhasil dihapus!'); // Ganti notifikasi
                        // Cari baris tabel berdasarkan ID mentee dan hapus
                        $('button.btn-hapus-mentee[data-mentee-id="' + url.split('/').pop() + '"]').closest('tr').fadeOut(300, function() { $(this).remove(); });
                        // Atau reload saja jika lebih mudah: location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        var errorMessage = 'Gagal menghapus mentee.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            try {
                                var jsonResponse = JSON.parse(xhr.responseText);
                                if (jsonResponse.message) {
                                    errorMessage = jsonResponse.message;
                                }
                            } catch(e) { console.error("Could not parse error response:", xhr.responseText); }
                        }
                        console.error('AJAX Error:', status, error, xhr.responseText);
                        alert(errorMessage); // Ganti notifikasi
                        button.prop('disabled', false).text('Hapus'); // Re-enable tombol
                    },
                    complete: function() {
                        button.prop('disabled', false).text('Hapus'); // Pastikan tombol aktif kembali
                    }
                });
            });

        });
    </script>
@endpush