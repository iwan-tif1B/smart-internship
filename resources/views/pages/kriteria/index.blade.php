@extends('layouts.app')

@section('title', 'Kriteria Penilaian')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQmQa7TBcVRBuKjXo/w1QkguhIyyLK4yrQX0Yv5i7k/tVElnXoltgFNnMqEzlnJwjnDHkz1NW0xPEaBwvsuJVksPdodPIFnFgzomxhJlY9lGqlTgfgcwKSjy23z4lwh9+nHm0Pdu7Z35wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .icon-button {
            width: 40px;
            height: 40px;
            background: #f1f5f9;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .icon-button i {
            font-size: 18px;
            color: #64748b;
        }

        .icon-button:hover {
            background: #e2e8f0;
        }

        .table thead th {
            background-color: #3c4b64;
            color: #ffffff !important;
            font-weight: bold;
        }

        .table thead {
            background-color: #3c4b64;
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .main-content {
            margin-top: 30px;
        }

        .table-rounded {
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid #dee2e6;
            border-radius: 12px;
            overflow: hidden;
        }

        .table-rounded thead th:first-child {
            border-top-left-radius: 12px;
        }

        .table-rounded thead th:last-child {
            border-top-right-radius: 12px;
        }

        .table-rounded tbody tr:last-child td:first-child {
            border-bottom-left-radius: 12px;
        }

        .table-rounded tbody tr:last-child td:last-child {
            border-bottom-right-radius: 12px;
        }

        .dropdown-menu.show {
            background-color: #ffffff !important;
            border: none;
            border-radius: 12px !important;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
            padding: 10px 0 !important;
            min-width: 150px;
        }

        .dropdown-item {
            color: #334155 !important;
            font-weight: 500 !important;
            padding: 10px 20px !important;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-item:hover {
            background-color: #f1f5f9 !important;
            color: #1e293b !important;
        }

        .dropdown-toggle::after {
            display: none !important;
        }

        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.2);
            background-color: transparent !important;
        }

        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - (0.5rem * 2));
            width: auto;
            max-width: 90%;
            margin: 0.5rem auto;
        }

        @media (min-width: 576px) {
            .modal-dialog-centered {
                min-height: calc(100% - (1.75rem * 2));
                max-width: 450px;
                margin: 1.75rem auto;
            }
        }

        .modal-content-custom {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #ffe0b2;
            color: #f57c00;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 60px;
            margin: 0 auto 15px;
        }

        .modal-icon.bg-success {
            background-color: #c3e6cb !important;
            color: #155724 !important;
        }

        .modal-icon.bg-warning {
            background-color: #ffeeba !important;
            color: #85640a !important;
        }

        .modal-icon.bg-danger {
            background-color: #f8d7da !important;
            color: #721c24 !important;
        }

        .modal-title-custom {
            font-size: 25px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .modal-message-custom {
            color: #555;
            margin-bottom: 0px;
            font-size: 15px;
        }

        .modal-buttons-custom {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 0px;
            flex-direction: row-reverse;
        }

        .btn-primary-custom {
            background-color: #1758B9;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-secondary-custom {
            background-color: #EB2027;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-primary-custom:hover {
            background-color: #134a96;
        }

        .btn-secondary-custom:hover {
            background-color: #b8181e;
            color: #fff;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="section-title">Kriteria Penilaian</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Kriteria Penilaian</div>
                </div>
            </div>

            <div class="section-body">
                @include('layouts.alert')

                <div class="table-responsive">
                    <table class="table table-striped table-rounded">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Posisi</th>
                                <th>Total Kriteria Penilaian</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posisi as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->nama_posisi }}</td>
                                <td>{{ $row->kriteria_penilaian_count }}</td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="{{ route('kriteria.create', ['id' => $row->id]) }}" class="icon-button" aria-label="Edit Kriteria Penilaian">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Jika ada pagination --}}
                {{-- <div class="float-right mt-3">
                    {{ $posisi->links() }}
                </div> --}}

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        $(document).ready(function () {
            // Jika ada modal atau interaksi JavaScript lainnya, tambahkan di sini
        });
    </script>
@endpush
