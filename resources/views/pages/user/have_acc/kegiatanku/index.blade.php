@extends('components.user.header1')

@section('title', 'Kegiatanku')

@section('content')
<section class="notifikasi py-5">
    <div class="container my-5">
        <div class="nav-tabs-box">
            <ul class="nav nav-tabs justify-content-center border-0 mb-0">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#status">Status Pendaftaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#kegiatan">Kegiatan Aktif</a>
                </li>
            </ul>
        </div>

        <div class="content-box">
            <div class="tab-content mt-4">
                <div class="tab-pane fade show active" id="status">
                    <div class="status-card">
                        <img
                            src="{{ asset('user/assets/icons/status.png') }}"
                            alt="Programmer"
                            class="status-img me-3" />
                        <div class="status-content">
                            <h5 class="fw-bold mb-1">Programmer</h5>
                            <p class="mb-2">
                                Tunggulah hasil seleksi dokumen Anda untuk melanjutkan ke
                                tahap seleksi selanjutnya.
                            </p>
                            <span class="badge bg-warning text-dark">Administrasi</span>
                        </div>
                    </div>

                    <div class="status-card">
                        <img
                            src="{{ asset('user/assets/icons/status.png') }}"
                            alt="System Analyst"
                            class="status-img me-3" />
                        <div class="status-content">
                            <h5 class="fw-bold mb-1">System Analyst</h5>
                            <p class="mb-1">
                                Mohon maaf, Anda belum berhasil lulus seleksi. Terima kasih
                                atas partisipasinya.
                            </p>
                            <small class="text-muted">Tanggal Ditolak: 30/07/2023</small><br />
                            <span class="badge bg-danger mt-2">Ditolak</span>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="kegiatan">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-lg-4 mb-4">
                                <div class="card sidebar-custom">
                                    <img src="{{ asset('user/assets/icons/status.png') }}" alt="Programmer" />
                                    <h6 class="fw-bold mt-2">Programmer</h6>
                                    <span class="badge badge-accepted mb-2">Diterima</span>
                                    <p class="small text-muted mb-1">
                                        Pastikan Anda mengisi laporan progres proyek Anda dan
                                        terima penghargaan berupa sertifikat setelah menyelesaikan
                                        magang.
                                    </p>
                                    <p class="text-muted small">30/06/2023 – 01/07/2024</p>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <h4 class="fw-bold">Programmer</h4>
                                <p class="mb-1">Nama : <strong>Winda Sari Pardede</strong></p>
                                <p class="mb-1">
                                    Tanggal Mulai : <strong>30/06/2023</strong>
                                </p>
                                <p class="mb-3">
                                    Tanggal Selesai : <strong>01/07/2024</strong>
                                </p>

                                <div class="card content-custom mb-4">
                                    <h6 class="fw-bold">Laporan Projek</h6>
                                    <p class="small text-muted">
                                        Perbarui terus presentasi projek Anda, dan pastikan
                                        memberikan yang terbaik dalam setiap aspek.
                                    </p>
                                    <div class="d-flex justify-content-end mb-2">
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#tambahLaporanModal">
                                            + Tambah
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table
                                            class="table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 50%; text-align: left">
                                                        Deskripsi
                                                    </th>
                                                    <th style="width: 15%">Presentase</th>
                                                    <th style="width: 15%">Status</th>
                                                    <th style="width: 10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: left">
                                                        Sistem Magang
                                                    </td>
                                                    <td>50%</td>
                                                    <td>
                                                        <span class="badge bg-primary">Proses</span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-secondary">
                                                            <i class="fas fa-align-justify"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class=" mb-3">
                                    <div class="card p-3 text-center rounded" style="border: 1px solid #ddd; border-radius: 10px;">
                                        <p class="mb-1 fw-bold" style="text-align: left">Testimoni</p>
                                        <p class="mb-2 small text-muted" style="text-align: left">
                                            Silahkan isi Testimoni Terlebih Dahulu Sebelum Mendownload Sertifikat.<br>
                                            <strong>Pastikan Anda Mengisi dengan Kalimat yang Sopan.</strong>
                                        </p>
                                        <button class="btn btn-danger rounded disabled" style="border-radius: 10px;">Testimoni</button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="card p-3 text-center rounded" style="border: 1px solid #ddd; border-radius: 10px;">
                                        <p class="mb-1 fw-bold" style="text-align: left">Sertifikat</p>
                                        <p class="mb-2 small text-muted" style="text-align: left">
                                            Selesaikan proyek magang Anda dengan baik dan raihlah sertifikat penghargaan yang akan kami berikan.<br>
                                            <strong>Pastikan Anda mendownload Sertifikat yang telah kami berikan.</strong>
                                        </p>
                                        <button class="btn btn-danger rounded disabled" style="border-radius: 10px;">Unduh</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="tambahLaporanModal" tabindex="-1" aria-labelledby="tambahLaporanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLaporanModalLabel">Tambah Judul Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="judulProject" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judulProject">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Simpan</button>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-backdrop {
        background-color: transparent !important;
        /* Membuat latar belakang menjadi transparan */
    }

    .modal-dialog {
        margin-top: auto;
        /* Mendorong modal ke bawah */
        margin-bottom: 30px;
        /* Memberikan jarak dari bawah */
    }

    .modal-footer {
        border-top: none !important;
        /* Menghapus garis di atas footer modal */
        margin-top: 10px !important;
        /* Mengurangi margin atas footer */
    }
</style>

@include('components.user.footer')
@endsection

@section('scripts')
<script>
    const simpanButton = document.querySelector('#tambahLaporanModal .modal-footer .btn-danger');
    const judulInput = document.getElementById('judulProject');

    simpanButton.addEventListener('click', function() {
        if (judulInput.value.trim() === '') {
            alert('Judul tidak boleh kosong!'); // Atau Anda bisa menampilkan pesan error yang lebih baik
            return; // Menghentikan proses penyimpanan jika judul kosong
        }

        // Jika judul tidak kosong, Anda bisa melanjutkan dengan logika penyimpanan data di sini
        console.log('Judul yang akan disimpan:', judulInput.value);
        // Lakukan AJAX request atau submit form di sini
    });
</script>
@endsection