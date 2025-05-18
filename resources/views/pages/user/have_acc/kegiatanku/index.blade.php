@extends('components.user.header1')

@section('title', 'Kegiatanku')

@section('content')
<section class="notifikasi py-5">
    <!-- Main Content -->
    <div class="container my-5">
        <!-- Tab Header -->
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

        <!-- Tab Content -->
        <div class="content-box">
            <div class="tab-content mt-4">
                <!-- Tab Status Pendaftaran -->
                <div class="tab-pane fade show active" id="status">
                    <div class="status-card">
                        <img
                            src="assets/icons/status.png"
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
                            src="assets/icons/status.png"
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

                <!-- Tab Kegiatan Aktif -->
                <div class="tab-pane fade" id="kegiatan">
                    <div class="container mt-4">
                        <div class="row">
                            <!-- Sidebar Kiri -->
                            <div class="col-lg-4 mb-4">
                                <div class="card sidebar-custom">
                                    <img src="assets/icons/status.png" alt="Programmer" />
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

                            <!-- Konten Kanan -->
                            <div class="col-lg-8">
                                <h4 class="fw-bold">Programmer</h4>
                                <p class="mb-1">Nama : <strong>Winda Sari Pardede</strong></p>
                                <p class="mb-1">
                                    Tanggal Mulai : <strong>30/06/2023</strong>
                                </p>
                                <p class="mb-3">
                                    Tanggal Selesai : <strong>01/07/2024</strong>
                                </p>

                                <!-- Laporan Proyek -->
                                <div class="card content-custom mb-4">
                                    <h6 class="fw-bold">Detail Laporan Proyek</h6>
                                    <p class="small text-muted">
                                        Perbarui terus presentasi projek Anda, dan pastikan
                                        memberikan yang terbaik dalam setiap aspek.
                                    </p>
                                    <div class="d-flex justify-content-end mb-2">
                                        <button class="btn btn-danger btn-sm">+ Tambah</button>
                                    </div>
                                    <div class="table-responsive">
                                        <table
                                            class="table table-bordered align-middle text-center">
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
                                                    <td>
                                                        Analisis kebutuhan, perancangan arsitektur
                                                        aplikasi, pengembangan kode, pengujian
                                                        fungsionalitas, serta perbaikan berdasarkan
                                                        feedback pengguna.
                                                    </td>
                                                    <td>50%</td>
                                                    <td>
                                                        <span class="badge bg-primary">Proses</span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-secondary">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>

@include('components.user.footer')
@endsection