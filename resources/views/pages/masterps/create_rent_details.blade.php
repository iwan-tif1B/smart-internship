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
                <h1>Master Data Forms -> {{ $masterps->name }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">rentsesion</div>
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
                                <input hidden name="master_ps_id" value="{{ $masterps->id }}">
                                <input hidden name="id_rent_session" value="{{ $rent_session->id }}">
                                <label>Name Rent Session</label>
                                <input type="text"
                                    class="form-control  @error('name_session')
                                is-invalid
                            @enderror"
                                    name="name_session" value="{{ old('name', $rent_session->name_session) }}">
                                @error('name_session')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Start Session</label>
                                <select class="form-control @error('start_session') is-invalid @enderror"
                                    name="start_session">
                                    <option value="" disabled selected>Choose time Start</option>
                                    @for ($i = 10; $i <= 22; $i++)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) . ':00' }}"
                                            {{ old('start_session', $rent_session->start_session) == str_pad($i, 2, '0', STR_PAD_LEFT) . ':00' ? 'selected' : '' }}>
                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) . ':00' }}
                                        </option>
                                    @endfor
                                </select>
                                @error('start_session')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>End Session</label>
                                <select class="form-control @error('end_session') is-invalid @enderror" name="end_session">
                                    <option value="" disabled selected>Chose time end</option>
                                    @for ($i = 10; $i <= 22; $i++)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) . ':00' }}"
                                            {{ old('end_session', $rent_session->end_session) == str_pad($i, 2, '0', STR_PAD_LEFT) . ':00' ? 'selected' : '' }}>
                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) . ':00' }}
                                        </option>
                                    @endfor
                                </select>
                                @error('end_session')
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
    <script>
        $(".test").on("click", function() {
            console.log('hallo');
        })
    </script>
@endpush
