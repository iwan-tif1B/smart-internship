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
                <h1>Master Data</h1>
                <div class="section-header-button">
                    <a href="{{ route('masterps.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add
                        Master Data PS</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">rentsession</a></div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Data Masters Ps</h2>


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

                                            <th>Name Master</th>
                                            <th>Price</th>
                                            <th>Addtional Fee on weekend</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($masterps as $i_ps)
                                            <tr>

                                                <td>{{ $i_ps->name }}
                                                </td>
                                                <td>Rp. {{ number_format($i_ps->price) }}
                                                </td>
                                                <td>Rp. {{ number_format($i_ps->additional_fee) }}
                                                </td>
                                                <td>{{ $i_ps->user->name }}</td>
                                                <td>{{ date('d-m-Y', strtotime($i_ps->created_at)) }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('masterps.edit', $i_ps->id) }}'
                                                            class="btn btn-sm btn-custom btn-icon mx-1">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a> <a href='{{ route('masterps.detail_masters', $i_ps->id) }}'
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
                                    {{ $masterps->withQueryString()->links() }}
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
