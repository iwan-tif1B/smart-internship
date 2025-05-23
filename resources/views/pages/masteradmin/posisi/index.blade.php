@extends('layouts.app')

@section('title', 'Posisi')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQmQa7TBcVRBuKjXo/w1QkguhIyyLK4yrQX0Yv5i7k/tVElnXoltgFNnMqEzlnJwjnDHkz1NW0xPEaBwvsuJVksPdodPIFnFgzomxhJlY9lGqlTgfgcwKSjy23z4lwh9+nHm0Pdu7Z35wg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<style>
    .badge-status {
        display: inline-block;
        padding: 6px 20px;
        border-radius: 9999px;
        font-size: 14px;
        font-weight: 600;
    }

    .badge-publish {
        background-color: #bbf7d0;
        color: #22c55e;
    }

    .badge-unpublish {
        background-color: #fce7f3;
        color: #db2777;
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
            <h1 class="section-title">Posisi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Posisi</div>
            </div>
        </div>

        <div class="section-body">
            @include('layouts.alert')

            <div class="row mb-4">
                <div class="col-md-12">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPosisiModal">
                        <i class="bi bi-plus-lg"></i> Tambah Posisi
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-rounded">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Posisi</th>
                            <th>Total Kuota</th>
                            <th>Kuota Tersedia</th>
                            <th>Deskripsi</th>
                            <th>Persyaratan</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($posisi as $key => $posisi)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $posisi['nama'] }}</td>
                            <td>{{ $posisi['total_kuota'] }}</td>
                            <td>{{ $posisi['kuota_tersedia'] }}</td>
                            <td>{{ $posisi['deksripsi'] }}</td>
                            <td>{{ $posisi['persyaratan'] }}</td>
                            <td>
                                @if ($posisi['status'] == 'publish')
                                <span class="badge-status badge-publish">Publish</span>
                                @elseif ($posisi['status'] == 'unpublish')
                                <span class="badge-status badge-unpublish">Unpublish</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($posisi['status'] == 'unpublish')
                                <div class="dropdown">
                                    <button class="icon-button dropdown-toggle" type="button"
                                        id="aksiDropdownPosisiPublish{{ $posisi['id'] }}" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        aria-label="Tampilkan opsi aksi untuk publish {{ $posisi['nama'] }}">
                                        <i class="fas fa-align-justify"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="aksiDropdownPosisiPublish{{ $posisi['id'] }}">
                                        <a class="dropdown-item publish-btn-posisi" href="#" data-toggle="modal"
                                            data-target="#publishModalPosisi{{ $posisi['id'] }}" data-id="{{ $posisi['id'] }}" data-nama="{{ $posisi['nama'] }}">
                                            <i class="fas fa-check-circle"></i> Publish
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="{{ route('posisi.edit', $posisi['id']) }}" class="dropdown-item">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete-btn-posisi" href="#" data-toggle="modal"
                                            data-target="#deleteModalPosisi{{ $posisi['id'] }}" data-id="{{ $posisi['id'] }}" data-nama="{{ $posisi['nama'] }}">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </div>
                                </div>

                                <div class="modal fade" id="publishModalPosisi{{ $posisi['id'] }}" tabindex="-1" role="dialog"
                                    aria-labelledby="publishModalPosisiLabel{{ $posisi['id'] }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-custom">
                                            <div class="modal-icon bg-success text-white">
                                                <i class="fas fa-check"></i>
                                            </div>
                                            <h5 class="modal-title modal-title-custom" id="publishModalPosisiLabel{{ $posisi['id'] }}">Konfirmasi Publish</h5>
                                            <div class="modal-body modal-message-custom">
                                                Apakah Anda yakin ingin mempublish posisi <strong><span id="namaPosisiPublish{{ $posisi['id'] }}"></span></strong>?
                                                <form id="publishFormPosisi{{ $posisi['id'] }}" method="POST" action="{{ route('posisi.update', $posisi['id']) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="publish">
                                                </form>
                                            </div>
                                            <div class="modal-footer modal-buttons-custom">
                                                <button type="button" class="btn btn-secondary btn-secondary-custom" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary btn-primary-custom" form="publishFormPosisi{{ $posisi['id'] }}">Publish</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="dropdown">
                                    <button class="icon-button dropdown-toggle" type="button"
                                        id="aksiDropdownPosisiUnpublish{{ $posisi['id'] }}" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        aria-label="Tampilkan opsi aksi untuk unpublish {{ $posisi['nama'] }}">
                                        <i class="fas fa-align-justify"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="aksiDropdownPosisiUnpublish{{ $posisi['id'] }}">
                                        <a class="dropdown-item unpublish-btn-posisi" href="#" data-toggle="modal"
                                            data-target="#unpublishModalPosisi{{ $posisi['id'] }}" data-id="{{ $posisi['id'] }}" data-nama="{{ $posisi['nama'] }}">
                                            <i class="fas fa-times-circle"></i> Unpublish
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="{{ route('posisi.edit', $posisi['id']) }}" class="dropdown-item">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete-btn-posisi" href="#" data-toggle="modal"
                                            data-target="#deleteModalPosisi{{ $posisi['id'] }}" data-id="{{ $posisi['id'] }}" data-nama="{{ $posisi['nama'] }}">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </div>
                                </div>

                                <div class="modal fade" id="unpublishModalPosisi{{ $posisi['id'] }}" tabindex="-1" role="dialog"
                                    aria-labelledby="unpublishModalPosisiLabel{{ $posisi['id'] }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-custom">
                                            <div class="modal-icon bg-warning text-white">
                                                <i class="fas fa-exclamation-triangle"></i>
                                            </div>
                                            <h5 class="modal-title modal-title-custom" id="unpublishModalPosisiLabel{{ $posisi['id'] }}">Konfirmasi Unpublish</h5>
                                            <div class="modal-body modal-message-custom">
                                                Apakah Anda yakin ingin meng-unpublish posisi <strong><span id="namaPosisiUnpublish{{ $posisi['id'] }}"></span></strong>?
                                                <form id="unpublishFormPosisi{{ $posisi['id'] }}" method="POST" action="{{ route('posisi.update', $posisi['id']) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="unpublish">
                                                </form>
                                            </div>
                                            <div class="modal-footer modal-buttons-custom">
                                                <button type="button" class="btn btn-secondary btn-secondary-custom" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary btn-primary-custom" form="unpublishFormPosisi{{ $posisi['id'] }}">Unpublish</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="modal fade" id="deleteModalPosisi{{ $posisi['id'] }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalPosisiLabel{{ $posisi['id'] }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-custom">
                                            <div class="modal-icon bg-danger text-white">
                                                <i class="bi bi-trash"></i>
                                            </div>
                                            <h5 class="modal-title modal-title-custom" id="deleteModalPosisiLabel{{ $posisi['id'] }}">Konfirmasi Hapus</h5>
                                            <div class="modal-body modal-message-custom">
                                                Apakah Anda yakin ingin menghapus posisi <strong><span id="namaPosisiDelete{{ $posisi['id'] }}"></span></strong>?
                                                <form id="deleteFormPosisi{{ $posisi['id'] }}" action="{{ route('posisi.destroy', $posisi['id']) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                            <div class="modal-footer modal-buttons-custom">
                                                <button type="button" class="btn btn-primary btn-primary-custom" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-secondary btn-secondary-custom" form="deleteFormPosisi{{ $posisi['id'] }}">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
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

<div class="modal fade" id="tambahPosisiModal" tabindex="-1" role="dialog" aria-labelledby="tambahPosisiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPosisiModalLabel">Tambah Posisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('posisi.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="kuota">Kuota</label>
                        <input type="number" class="form-control" id="kuota" name="total_kuota" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="kuota_tersedia">Kuota Tersedia</label>
                        <input type="number" class="form-control" id="kuota_tersedia" name="kuota_tersedia" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="persyaratan">Persyaratan</label>
                        <textarea class="form-control" id="persyaratan" name="persyaratan" rows="5"></textarea>
                        {{-- Anda mungkin ingin menambahkan library WYSIWYG editor di sini --}}
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary simpan_posisi">Simpan</button>
            </div>
            </form>
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
        // Inisialisasi modal tambah posisi (opsional)
        $('#tambahPosisiModal').on('show.bs.modal', function(e) {
            // Tambahkan logika jika diperlukan saat modal dibuka
            $(this).removeAttr('aria-hidden');
        });

        $('#tambahPosisiModal').on('hidden.bs.modal', function(e) {
            $(this).attr('aria-hidden', 'true');
        });

        // Fungsi untuk mengikat event listener ke tombol publish dan delete
        function bindButtonEvents() {
            $('.publish-btn-posisi').off('click').on('click', function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                $('#namaPosisiPublish' + id).text(nama);
                $('#publishModalPosisi' + id).modal('show');
            });

            $('.delete-btn-posisi').off('click').on('click', function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                $('#namaPosisiDelete' + id).text(nama);
                $('#deleteModalPosisi' + id).modal('show');
            });
        }

        // Panggil fungsi untuk mengikat event listener awal
        bindButtonEvents();

        // Simpan posisi (AJAX)
        $('.simpan_posisi').on('click', function(e) {
            e.preventDefault();

            let nama = $('#nama').val();
            let kuota = $('#kuota').val();
            let kuota_tersedia = $('#kuota_tersedia').val();
            let deskripsi = $('#deskripsi').val();
            let persyaratan = $('#persyaratan').val();

            $.ajax({
                url: "{{ route('posisi.store') }}",
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    nama: nama,
                    total_kuota: kuota,
                    kuota_tersedia: kuota_tersedia,
                    deskripsi: deskripsi,
                    persyaratan: persyaratan
                },
                success: function(res) {
                    alert(res.message);

                    // Tutup modal
                    $('#tambahPosisiModal').modal('hide');

                    // Reset form
                    $('#tambahPosisiModal form')[0].reset();

                    // Tambah baris ke tabel tanpa reload
                    var newRow = $(`
                        <tr>
                            <td>${nama}</td>
                            <td>${kuota}</td>
                            <td>${kuota_tersedia}</td>
                            <td>${deskripsi}</td>
                            <td>${persyaratan}</td>
                            <td>
                                <button class="btn btn-sm btn-warning publish-btn-posisi" data-id="${res.data?.id || ''}" data-nama="${nama}">Publish</button>
                                <button class="btn btn-sm btn-danger delete-btn-posisi" data-id="${res.data?.id || ''}" data-nama="${nama}">Hapus</button>
                            </td>
                        </tr>
                    `);

                    // Hapus baris pertama jika ada duplikat (mungkin ini masalahnya)
                    $('#tabel-posisi tbody tr:first').remove();
                    $('#tabel-posisi tbody').append(newRow);


                    // Re-attach event listeners for new buttons.  IMPORTANT
                    bindButtonEvents(); // Panggil fungsi setelah menambahkan baris baru

                    // Fade in efek untuk baris yang baru ditambahkan
                    newRow.hide().fadeIn('slow');

                },
                error: function(xhr) {
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    });
</script>
@endpush