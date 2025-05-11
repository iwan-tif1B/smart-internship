@extends('layouts.app')

@section('title', 'Detail Soal')
@push('style')
@endpush
@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Soal</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('kemampuan.index') }}">Kemampuan</a></div>
                <div class="breadcrumb-item active">Detail Soal</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Deskripsi</h5>
                    <p>{{ $kemampuan->deskripsi ?? '-' }}</p>

                    <h5 class="mb-3">Soal</h5>
                    <p>{!! nl2br(e($kemampuan->soal)) !!}</p>

                    <h5 class="mb-3">Jawaban</h5>
                    <p>{!! nl2br(e($kemampuan->jawaban)) !!}</p>

                    <h5 class="mb-3">Informasi Tambahan</h5>
                    <ul>
                        <li>Nama Lengkap: {{ $kemampuan->nama }}</li>
                        <li>Email: {{ $kemampuan->email }}</li>
                        <li>Posisi: {{ $kemampuan->posisi }}</li>
                        <li>Tanggal Tes: {{ \Carbon\Carbon::parse($kemampuan->tanggal_tes)->translatedFormat('d M Y') }}</li>
                        <li>Status:
                            @if($kemampuan->status == 'proses')
                                <span class="badge badge-warning">Proses</span>
                            @elseif($kemampuan->status == 'lulus')
                                <span class="badge badge-success">Lulus</span>
                            @elseif($kemampuan->status == 'ditolak')
                                <span class="badge badge-danger">Ditolak</span>
                            @endif
                        </li>
                        </ul>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('kemampuan.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection