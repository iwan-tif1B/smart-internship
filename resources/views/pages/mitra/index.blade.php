@extends('layouts.app')

@section('title', 'Mitra')

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

        .badge-active {
            background-color: #bbf7d0;
            color: #22c55e;
        }

        .badge-inactive {
            background-color: #fce7f3;
            color: #db2777;
        }

        .icon-button {
        width: 40px;
        height: 40px;
        background: #f1f5f9;
        border: none;
        position: relative; /* Untuk menjadi containing block bagi ikon yang diposisikan absolute */
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        margin: 0 5px;
        display: inline-flex; /* Atau display: inline-block; jika tidak ingin flexbox mempengaruhi layout lain */
        align-items: center;
        justify-content: center;
    }

    .icon-button i {
        font-size: 18px;
        color: #64748b;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .icon-button:hover {
        background: #e2e8f0;
    }
        .table thead th {
            background-color: #3c4b64;
            color: #ffffff !important;
            font-weight: bold;
            text-align: left;
        }

        .table thead {
            background-color: #3c4b64;
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
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

        .align-middle {
            vertical-align: middle !important;
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
                <h1 class="section-title">Mitra</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Mitra</div>
                </div>
            </div>

            <div class="section-body">
                @include('layouts.alert')

                <div class="row mb-4">
                    <div class="col-md-12">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahMitraModal">
                            <i class="bi bi-plus-lg"></i> Tambah Mitra
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-rounded">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mitra</th>
                                <th class="text-center align-middle">Total Kuota</th>
                                <th class="text-center align-middle">Kuota Tersedia</th>
                                <th class="text-center align-middle">Status</th>
                                <th class="text-center align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $dummyMitra = [
                                    ['id' => 1, 'nama' => 'Universitas Islam Riau', 'total_kuota' => 10, 'kuota_tersedia' => 6, 'is_blacklisted' => false],
                                    ['id' => 2, 'nama' => 'SMK Negeri 3 Pekanbaru', 'total_kuota' => 7, 'kuota_tersedia' => 4, 'is_blacklisted' => true],
                                    // Tambahkan data mitra lain di sini (pastikan ada key 'is_blacklisted')
                                ];
                            @endphp

                            @foreach ($dummyMitra as $key => $mitra)
                                <tr>
                                    <td class="align-middle">{{ $key + 1 }}</td>
                                    <td class="align-middle">{{ $mitra['nama'] }}</td>
                                    <td class="text-center align-middle">{{ $mitra['total_kuota'] }}</td>
                                    <td class="text-center align-middle">{{ $mitra['kuota_tersedia'] }}</td>
                                    <td class="text-center align-middle">
                                        @if ($mitra['is_blacklisted'])
                                            <span class="badge-status badge-inactive">Blacklisted</span>
                                        @else
                                            <span class="badge-status badge-active">Active</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="dropdown">
                                            <button class="icon-button dropdown-toggle" type="button"
                                                    id="aksiDropdownMitra{{ $mitra['id'] }}" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    aria-label="Tampilkan opsi aksi untuk {{ $mitra['nama'] }}">
                                                <i class="fas fa-align-justify"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="aksiDropdownMitra{{ $mitra['id'] }}">
                                                @if ($mitra['is_blacklisted'])
                                                    <a class="dropdown-item unblacklist-btn-mitra" href="#" data-toggle="modal"
                                                       data-target="#unblacklistModalMitra{{ $mitra['id'] }}" data-id="{{ $mitra['id'] }}" data-nama="{{ $mitra['nama'] }}">
                                                        <i class="fas fa-check"></i> Unblacklist
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                @else
                                                    <a class="dropdown-item blacklist-btn-mitra" href="#" data-toggle="modal"
                                                       data-target="#blacklistModalMitra{{ $mitra['id'] }}" data-id="{{ $mitra['id'] }}" data-nama="{{ $mitra['nama'] }}">
                                                        <i class="fas fa-ban"></i> Blacklist
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                @endif
                                                <a href="{{ route('mitra.edit', $mitra['id']) }}" class="dropdown-item">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete-btn-mitra" href="#" data-toggle="modal"
                                                   data-target="#deleteModalMitra{{ $mitra['id'] }}" data-id="{{ $mitra['id'] }}" data-nama="{{ $mitra['nama'] }}">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="blacklistModalMitra{{ $mitra['id'] }}" tabindex="-1" role="dialog"
                                     aria-labelledby="blacklistModalMitraLabel{{ $mitra['id'] }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-custom">
                                            <div class="modal-icon bg-warning text-white">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </div>
                                            <h5 class="modal-title modal-title-custom" id="blacklistModalMitraLabel{{ $mitra['id'] }}">Konfirmasi Blacklist</h5>
                                            <div class="modal-body modal-message-custom">
                                                Apakah Anda yakin ingin mem-blacklist mitra <strong><span id="namaMitraBlacklist{{ $mitra['id'] }}">{{ $mitra['nama'] }}</span></strong>?
                                                <form id="blacklistFormMitra{{ $mitra['id'] }}" action="{{ route('mitra.blacklist', $mitra['id']) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                </form>
                                            </div>
                                            <div class="modal-footer modal-buttons-custom">
                                                <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-secondary btn-secondary-custom" form="blacklistFormMitra{{ $mitra['id'] }}">Blacklist</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="unblacklistModalMitra{{ $mitra['id'] }}" tabindex="-1" role="dialog"
                                     aria-labelledby="unblacklistModalMitraLabel{{ $mitra['id'] }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-custom">
                                            <div class="modal-icon bg-success text-white">
                                                <i class="fas fa-check"></i>
                                            </div>
                                            <h5 class="modal-title modal-title-custom" id="unblacklistModalMitraLabel{{ $mitra['id'] }}">Konfirmasi Unblacklist</h5>
                                            <div class="modal-body modal-message-custom">
                                                Apakah Anda yakin ingin meng-unblacklist mitra <strong><span id="namaMitraUnblacklist{{ $mitra['id'] }}">{{ $mitra['nama'] }}</span></strong>?
                                                <form id="unblacklistFormMitra{{ $mitra['id'] }}" action="{{ route('mitra.unblacklist', $mitra['id']) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                </form>
                                            </div>
                                            <div class="modal-footer modal-buttons-custom">
                                                <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-secondary btn-secondary-custom" form="unblacklistFormMitra{{ $mitra['id'] }}">Unblacklist</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="deleteModalMitra{{ $mitra['id'] }}" tabindex="-1" role="dialog"
                                     aria-labelledby="deleteModalMitraLabel{{ $mitra['id'] }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-custom">
                                            <div class="modal-icon bg-danger text-white">
                                                <i class="bi bi-trash"></i>
                                            </div>
                                            <h5 class="modal-title modal-title-custom" id="deleteModalMitraLabel{{ $mitra['id'] }}">Konfirmasi Hapus</h5>
                                            <div class="modal-body modal-message-custom">
                                                Apakah Anda yakin ingin menghapus mitra <strong><span id="namaMitraDelete{{ $mitra['id'] }}">{{ $mitra['nama'] }}</span></strong>?
                                                <form id="deleteFormMitra{{ $mitra['id'] }}" action="{{ route('mitra.destroy', $mitra['id']) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                            <div class="modal-footer modal-buttons-custom">
                                                <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-secondary btn-secondary-custom" form="deleteFormMitra{{ $mitra['id'] }}">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Jika ada pagination --}}
                {{-- <div class="float-right mt-3">
                    {{ $mitras->links() }}
                </div> --}}

            </div>
        </section>
    </div>

    <div class="modal fade" id="tambahMitraModal" tabindex="-1" role="dialog" aria-labelledby="tambahMitraModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahMitraModalLabel">Tambah Mitra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('mitra.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Mitra</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="total_kuota">Total Kuota</label>
                            <input type="number" class="form-control" id="total_kuota" name="total_kuota" required>
                        </div>
                        <div class="form-group">
                            <label for="kuota_tersedia">Kuota Tersedia</label>
                            <input type="number" class="form-control" id="kuota_tersedia" name="kuota_tersedia" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
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
        $(document).ready(function () {
            $('#tambahMitraModal').on('show.bs.modal', function (e) {
                $(this).find('form')[0].reset(); // Reset form ketika modal tambah ditutup
            });

            $('.blacklist-btn-mitra').on('click', function () {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                $('#namaMitraBlacklist' + id).text(nama);
                $('#blacklistModalMitra' + id).modal('show');
            });

            $('.unblacklist-btn-mitra').on('click', function () {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                $('#namaMitraUnblacklist' + id).text(nama);
                $('#unblacklistModalMitra' + id).modal('show');
            });

            $('.delete-btn-mitra').on('click', function () {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                $('#namaMitraDelete' + id).text(nama);
                $('#deleteModalMitra' + id).modal('show');
            });
        });
    </script>
@endpush