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
                    <a href="{{ route('masterps.create_details_session', $rent_session->id) }}" class="btn btn-primary"><i
                            class="fas fa-plus"></i> Add Detail Session</a>
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
                <h2 class="section-title">Details Master [ {{ $rent_session->name_session ?? '' }} ]</h2>


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

                                            <th>Name Playstation</th>
                                            <th>Note</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($detail_session as $i_ps)
                                            <tr>

                                                <td>{{ $i_ps->name_playstation }} </td>
                                                <td>{{ $i_ps->note }}</td>
                                                <td>{{ $i_ps->user->name }}</td>
                                                <td>{{ date('d-m-Y', strtotime($i_ps->created_at)) }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('masterps.edit_details_session', $i_ps->id) }}'
                                                            class="btn btn-sm btn-custom btn-icon mx-1">
                                                            <i class="fas fa-edit"></i>
                                                            Edit</a>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </table>
                                </div>
                                <div class="float-right">
                                    {{-- {{ $detail_session->withQueryString()->links() }} --}}
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
