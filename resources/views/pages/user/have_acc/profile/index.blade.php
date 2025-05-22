@extends('components.user.header1')

@section('title', 'Profile')

@section('content')
<section class="notifikasi py-5">
    <!-- Profil -->
    <div class="container mt-5 poppins">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Profile</h1>
            <a href="#" class="text-decoration-none"><i class="bi bi-pencil-square me-1"></i> Edit Profile</a>
        </div>

        <!-- Data Pribadi -->
        <div class="card pribadi">
            <h4 class="section-title">Data Pribadi</h4>
            <div class="row align-items-center">
                <div class="col-md-3 text-center mb-3">
                    <img
                        src="assets/img/exprofil.png"
                        alt="Foto Profil"
                        class="profile-img" />
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <span class="label">Nama :</span>
                                <span class="value">WINDA SARI PARDEDE</span>
                            </p>
                            <p>
                                <span class="label">NIM :</span>
                                <span class="value">203510494</span>
                            </p>
                            <p>
                                <span class="label">Agama :</span>
                                <span class="value">Islam</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <span class="label">Email :</span>
                                <span class="value">windasaripardede@gmail.com</span>
                            </p>
                            <p>
                                <span class="label">No. Telepon :</span>
                                <span class="value">085361047353</span>
                            </p>
                            <p>
                                <span class="label">Jenis Kelamin :</span>
                                <span class="value">Laki - Laki</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Data Akademik -->
        <div class="card akademik">
            <h4 class="section-title">Data Akademik</h4>
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <span class="label">Asal Institusi :</span>
                        <span class="value">Politeknik Caltex Riau</span>
                    </p>
                    <p>
                        <span class="label">Curriculum Vitae :</span>
                        <a class="value" href="#">1997142482424.pdf <i class="bi bi-box-arrow-up-right"></i></a>
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        <span class="label">Jurusan :</span>
                        <span class="value">Teknik Informatika</span>
                    </p>
                    <p>
                        <span class="label">Surat Institusi :</span>
                        <a class="value" href="#">1997142482424.pdf <i class="bi bi-box-arrow-up-right"></i></a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Periode Magang -->
        <div class="card periode">
            <h4 class="section-title">Periode Magang</h4>
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <span class="label">Tanggal Mulai Magang :</span>
                        <span class="value">30/07/2023</span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        <span class="label">Tanggal Selesai Magang :</span>
                        <span class="value">31/07/2023</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.user.footer')
@endsection