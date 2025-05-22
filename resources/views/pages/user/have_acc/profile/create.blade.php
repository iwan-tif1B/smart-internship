@extends('components.user.header1')

@section('title', 'Isi Profil')

@section('content')
<section class="notifikasi py-5">
    <div class="container mt-5 poppins">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Isi Profil</h1>
            <button type="submit" form="profileForm" class="btn btn-primary"><i class="bi bi-plus-square me-1"></i> Tambah Profil</button>
        </div>

        <form id="profileForm">
            <div class="card pribadi mb-4">
                <h4 class="section-title">Data Pribadi</h4>
                <div class="row align-items-center">
                    <div class="col-md-3 text-center mb-3">
                        <img
                            src="{{ asset('assets/img/default-profile.png') }}"
                            alt="Foto Profil"
                            class="profile-img rounded-circle shadow-sm mb-2"
                            style="width: 120px; height: 120px; object-fit: cover;">
                        <div class="mb-2">
                            <label for="foto_profil" class="form-label visually-hidden">Unggah Foto Profil</label>
                            <input type="file" class="form-control form-control-sm" id="foto_profil">
                            <small class="text-muted">Format: JPG, PNG. Max: 2MB</small>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" id="nim" placeholder="Masukkan NIM">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="agama" class="form-label">Agama</label>
                                <select class="form-select" id="agama">
                                    <option value="" selected>Pilih Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Masukkan Email">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_telepon" class="form-label">No. Telepon</label>
                                <input type="text" class="form-control" id="no_telepon" placeholder="Masukkan No. Telepon">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin">
                                    <option value="" selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki - Laki">Laki - Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card akademik mb-4">
                <h4 class="section-title">Data Akademik</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="asal_institusi" class="form-label">Asal Institusi</label>
                        <input type="text" class="form-control" id="asal_institusi" placeholder="Masukkan Asal Institusi">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" placeholder="Masukkan Jurusan">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cv" class="form-label">Curriculum Vitae</label>
                        <input type="file" class="form-control" id="cv">
                        <small class="text-muted">Upload CV Anda (PDF)</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="surat_institusi" class="form-label">Surat Institusi</label>
                        <input type="file" class="form-control" id="surat_institusi">
                        <small class="text-muted">Upload Surat Institusi (PDF)</small>
                    </div>
                </div>
            </div>

            <div class="card periode mb-4">
                <h4 class="section-title">Periode Magang</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai Magang</label>
                        <input type="date" class="form-control" id="tanggal_mulai">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai Magang</label>
                        <input type="date" class="form-control" id="tanggal_selesai">
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@include('components.user.footer')
@endsection