@extends('layouts.app')

@section('title', 'Advanced Forms')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Master Data Forms</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Masters</div>
                </div>
            </div>

            <div class="section-body">
                {{-- <h2 class="section-title">Users</h2> --}}



                <div class="card">
                    <form action="{{ $url }}" method="POST">
                        @csrf
                        @method('POST') <!-- Spoof the form method as PUT -->
                        <div class="card-body">
                            <div class="form-group">
                                <input hidden name="rent_session_id" value="{{ old('name', $rent_session->id) }}">
                                <input hidden name="detail_session_id" value="{{ old('name', $detail_session->id) }}">
                                <label>Name Playstation</label>
                                <input type="text"
                                    class="form-control  @error('name_playstation')
                                is-invalid
                            @enderror"
                                    name="name_playstation"
                                    value="{{ old('name_playstation', $detail_session->name_playstation) }}">
                                @error('name_playstation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <input type="text"
                                    class="form-control @error('note')
                                is-invalid
                            @enderror"
                                    name="note" value="{{ old('note', $detail_session->note) }}">
                                @error('note')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
