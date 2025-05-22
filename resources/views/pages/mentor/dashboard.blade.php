@extends('layouts.appmentor')

@section('main')
<div class="main-content">
    <div class="section-body">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm text-center border-0 rounded-lg">
                        <div class="card-body py-3">
                            <div class="mb-2">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background-color: #0033cc;">
                                    <i class="fas fa-user-friends fa-2x text-white"></i>
                                </div>
                            </div>
                            <h3 class="mb-0">50</h3>
                            <p class="text-muted mb-1">Mentee Aktif</p>
                            <div class="progress rounded-pill" style="height: 8px;">
                                <div class="progress-bar rounded-pill" style="width: 50%; background-color: #0033cc;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm text-center border-0 rounded-lg">
                        <div class="card-body py-3">
                            <div class="mb-2">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background-color: #6f42c1;">
                                    <i class="fas fa-clipboard-list fa-2x text-white"></i>
                                </div>
                            </div>
                            <h3 class="mb-0">60</h3>
                            <p class="text-muted mb-1">Monitoring Magang</p>
                            <div class="progress rounded-pill" style="height: 8px;">
                                <div class="progress-bar rounded-pill" style="width: 60%; background-color: #6f42c1;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm text-center border-0 rounded-lg">
                        <div class="card-body py-3">
                            <div class="mb-2">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background-color: #198754;">
                                    <i class="fas fa-graduation-cap fa-2x text-white"></i>
                                </div>
                            </div>
                            <h3 class="mb-0">70</h3>
                            <p class="text-muted mb-1">Total Alumni Magang</p>
                            <div class="progress rounded-pill" style="height: 8px;">
                                <div class="progress-bar rounded-pill bg-success" style="width: 70%; background-color: #198754;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection