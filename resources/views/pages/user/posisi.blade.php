@extends('components.user.header2')

@section('title', 'posisi')

@section('content')
<!-- Section: Posisi Magang -->
<section class="container-p">
    <div class="magang-card">
        <div class="card-body">
            <h5 class="card-title">
                Programmer
                <span class="kuota">Kuota: 2</span>
            </h5>
            <p class="card-text">
                Bergabunglah sebagai Magang Programmer untuk mengembangkan
                keterampilan Anda dalam penulisan kode dan pengujian perangkat
                lunak.
            </p>
            <div class="btn-wrapper">
                <a href="#" class="lihat-link">Lihat Selengkapnya</a>
                <button class="btn-ajukan" disabled>Ajukan</button>
            </div>
        </div>
    </div>
</section>

@include('components.user.footer')
@endsection