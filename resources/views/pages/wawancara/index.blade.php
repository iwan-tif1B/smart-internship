@extends('layouts.app')

@section('title', 'Wawancara')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQmQa7TBcVRBuKjXo/w1QkguhIyyLK4yrQX0Yv5i7k/tVElnXoltgFNnMqEzlnJwjnDHkz1NW0xPEaBwvsuJVksPdodPIFnFgzomxhJlY9lGqlTgfgcwKSjy23z4lwh9+nHm0Pdu7Z35wg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .badge-status {
            display: inline-block;
            padding: 6px 20px;
            border-radius: 9999px;
            font-size: 14px;
            font-weight: 600;
        }
        .badge-proses {
            background-color: #c7d7fe;
            color: #3b82f6;
        }
        .badge-lulus {
            background-color: #bbf7d0;
            color: #22c55e;
        }
        .badge-ditolak {
            background-color: #ffe0b2; /* Warna untuk ditolak, sesuaikan jika perlu */
            color: #f57c00; /* Warna teks untuk ditolak, sesuaikan jika perlu */
        }
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
            background-color: rgba(0, 0, 0, 0.2); /* Ubah nilai alpha (0.0 - 1.0) sesuai keinginan */
            background-color: transparent !important;
        }

        /* Styling untuk modal yang baru */
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - (0.5rem * 2));
            width: auto;
            max-width: 90%; /* Ubah max-width menjadi persentase untuk layar kecil */
            margin: 0.5rem auto;
        }

        @media (min-width: 576px) {
            .modal-dialog-centered {
                min-height: calc(100% - (1.75rem * 2));
                max-width: 450px; /* Kembali ke ukuran tetap untuk layar yang lebih besar */
                margin: 1.75rem auto;
            }
        }

        .modal-content-custom {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            text-align: center;
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
            background-color: #1758B9; /* Warna biru tombol Terima */
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-secondary-custom {
            background-color: #EB2027; /* Warna merah tombol Batal */
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-danger-custom {
            background-color: #dc3545; /* Warna merah untuk tombol Tolak di modal */
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

        .btn-danger-custom:hover {
            background-color: #c82333;
            color: #fff;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="section-title">Wawancara</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Wawancara</div>
                </div>
            </div>

            <div class="section-body">
                @include('layouts.alert')

                <div class="row mb-4 align-items-center">
                    <div class="col-md-2 d-flex align-items-center">
                        <label class="mr-2 mb-0">Show</label>
                        <select class="form-control form-control-sm" style="width: 80px;">
                            <option>10</option>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                        <label class="ml-2 mb-0">entries</label>
                    </div>

                    <div class="col-md-8">
                        <form action="{{ route('wawancara.index') }}" method="GET">
                            <div class="position-relative">
                                <span class="position-absolute" style="top: 50%; left: 15px; transform: translateY(-50%); color: #aaa;">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" name="judul" value="{{ request('judul') }}"
                                       class="form-control pl-5 shadow-sm"
                                       placeholder="Cari Nama atau Posisi" style="height: 45px;">
                            </div>
                        </form>
                    </div>

                    <div class="col-md-2">
                        <form action="{{ route('wawancara.index') }}" method="GET">
                            <select name="status" class="form-control form-control-sm shadow-sm" style="height: 45px;" onchange="this.form.submit()">
                                <option value="">Filter</option>
                                <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-rounded">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No. Telephone</th>
                                <th>Posisi</th>
                                <th>Asal Institusi</th>
                                <th class="text-center">Periode</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($wawancara as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->no_telp }}</td>
                                    <td>{{ $item->posisi }}</td>
                                    <td>{{ $item->asal_institusi }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->periode_mulai)->translatedFormat('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($item->periode_selesai)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="text-center">
                                        @if($item->status == 'proses')
                                            <span class="badge-status badge-proses">Proses</span>
                                        @elseif($item->status == 'lulus')
                                            <span class="badge-status badge-lulus">Lulus</span>
                                        @elseif($item->status == 'ditolak')
                                            <span class="badge-status badge-ditolak">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="icon-button dropdown-toggle" type="button" id="aksiDropdown{{ $item->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-align-justify"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="aksiDropdown{{ $item->id }}">
                                                <a class="dropdown-item terima-btn" href="#" data-toggle="modal" data-target="#terimaModal" data-id="{{ $item->id }}"><i class="fas fa-check"></i> Terima</a>
                                                <a class="dropdown-item tolak-btn" href="#" data-toggle="modal" data-target="#tolakModal" data-id="{{ $item->id }}"><i class="fas fa-times"></i> Tolak</a>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data wawancara.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="float-right mt-3">
                    {{ $wawancara->withQueryString()->links() }}
                </div>
            </div>
        </section>
    </div>

    {{-- Modal Terima --}}
    <div class="modal fade" id="terimaModal" tabindex="-1" role="dialog" aria-labelledby="terimaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-custom">
                <div class="modal-icon">
                    <i class="fas fa-check" style="font-size: 40px; color: #22c55e;"></i>
                </div>
                <h5 class="modal-title modal-title-custom" id="terimaModalLabel">Terima Pendaftar?</h5>
                <div class="modal-body modal-message-custom">
                    Apakah Anda yakin ingin menerima pendaftar ini?
                    <form id="terimaForm" method="POST" action="{{ route('wawancara.lulus', ['wawancara' => '__id__']) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="wawancara" id="terima_wawancara_id">
                    </form>
                </div>
                <div class="modal-footer modal-buttons-custom">
                    <button type="button" class="btn btn-secondary btn-secondary-custom" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-primary-custom" form="terimaForm">Terima</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tolak --}}
    <div class="modal fade" id="tolakModal" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-custom">
                <div class="modal-icon">
                    <i class="fas fa-times" style="font-size: 40px; color: #dc3545;"></i>
                </div>
                <h5 class="modal-title modal-title-custom" id="tolakModalLabel">Tolak Pendaftar?</h5>
                <div class="modal-body modal-message-custom">
                    Apakah Anda yakin ingin menolak pendaftar ini?
                    <form id="tolakForm" method="POST" action="{{ route('wawancara.tolak', ['administrasi_id' => '__id__']) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="administrasi_id" id="tolak_administrasi_id">
                    </form>
                </div>
                <div class="modal-footer modal-buttons-custom">
                    <button type="button" class="btn btn-secondary btn-secondary-custom" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger-custom" form="tolakForm">Tolak</button>
                </div>
            </div>
        </div>
    </div>
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
        $(document).ready(function() {
            $('.terima-btn').on('click', function() {
                var id = $(this).data('id');
                $('#terimaForm').attr('action', '{{ route('wawancara.lulus', ['wawancara' => '__id__']) }}'.replace('__id__', id));
                $('#terima_wawancara_id').val(id);
                $('#terimaModal').modal('show');
            });

            $('#terimaModal').on('hidden.bs.modal', function (e) {
                $('#terima_wawancara_id').val('');
            });

            $('.tolak-btn').on('click', function() {
                var id = $(this).data('id');
                $('#tolakForm').attr('action', '{{ route('wawancara.tolak', ['administrasi_id' => '__id__']) }}'.replace('__id__', id));
                $('#tolak_administrasi_id').val(id);
                $('#tolakModal').modal('show');
            });

            $('#tolakModal').on('hidden.bs.modal', function (e) {
                $('#tolak_administrasi_id').val('');
            });
        });
    </script>
@endpush