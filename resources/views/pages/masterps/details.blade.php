@extends('layouts.app')

@section('title', 'Master')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Master Data </h1>
                <div class="section-header-button">
                    <a href="{{ route('masterps.create_rent_session', $masterps->id) }}" class="btn btn-primary"><i
                            class="fas fa-plus"></i> Add Rent Session</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">master</a></div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Details Master [ {{ $masterps->name ?? '' }} ]</h2>


                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h4 class="text-custom">All Posts</h4>
                            </div> --}}
                            <div class="card-body">

                                <div class="float-right">
                                    <form method="GET" action="{{ route('masterps.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>Name Rent session</th>
                                            <th>Start Session</th>
                                            <th>End Session</th>
                                            <th>Hour</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($rent_session as $i_ps)
                                            <tr>

                                                <td>{{ $i_ps->name_session }} </td>
                                                <td>{{ $i_ps->start_session }} WIB</td>
                                                <td>{{ $i_ps->end_session }} WIB</td>
                                                <td><?php
                                                $start = $i_ps->start_session; // format: "HH:00"
                                                $end = $i_ps->end_session; // format: "HH:00"
                                                
                                                // Mengonversi start_session dan end_session ke timestamp
                                                $start_timestamp = strtotime($start);
                                                $end_timestamp = strtotime($end);
                                                $diff_in_seconds = $end_timestamp - $start_timestamp;
                                                $diff_in_hours = $diff_in_seconds / 3600;
                                                echo $diff_in_hours;
                                                ?>
                                                </td>
                                                <td>{{ $i_ps->user->name }}</td>
                                                <td>{{ date('d-m-Y', strtotime($i_ps->created_at)) }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('masterps.edit_rent_session', $i_ps->id) }}'
                                                            class="btn btn-sm btn-custom btn-icon mx-1">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a> <a href='{{ route('masterps.detail_session', $i_ps->id) }}'
                                                            class="btn btn-sm btn-custom btn-info">
                                                            <i class="fa-solid fa-circle-info"></i>
                                                            Details
                                                        </a>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $rent_session->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
