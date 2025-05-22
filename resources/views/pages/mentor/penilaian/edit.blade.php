@extends('layouts.appmentor')

@section('title', 'Penilaian')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">
<style>
    .main-content {
        margin-top: 30px;
    }

    .card-custom {
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background-color: #fff;
    }

    .card-title-custom {
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section-title {
        font-size: 18px;
        font-weight: bold;
        color: #555;
        margin-bottom: 15px;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 10px;
    }

    .form-group-custom {
        margin-bottom: 15px;
    }

    .form-group-custom label {
        display: block;
        font-size: 14px;
        color: #777;
        margin-bottom: 5px;
    }

    .form-control-custom {
        border: 1px solid #d0d0d0;
        border-radius: 8px;
        padding: 10px;
        width: 100%;
        font-size: 15px;
        transition: border-color 0.3s ease;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #4CAF50;
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
    }

    .btn-add-kriteria {
        background-color: #e0e0e0;
        color: #333;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 10px;
    }

    .btn-add-kriteria:hover {
        background-color: #c0c0c0;
    }

    .btn-danger-custom {
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 15px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-left: 10px;
    }

    .btn-danger-custom:hover {
        background-color: #d32f2f;
    }

    .form-actions {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-secondary-custom {
        background-color: #b0bec5;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-secondary-custom:hover {
        background-color: #78909c;
    }

    .btn-primary-custom {
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary-custom:hover {
        background-color: #43a047;
    }

    .kriteria-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    /* Gaya tambahan untuk menampilkan form berdampingan */
    .row-flex {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        /* Menambahkan jarak antara kolom */
    }

    .col-md-6 {
        flex: 0 0 calc(50% - 10px);
        /* Lebar 50% dikurangi jarak antar kolom */
        max-width: calc(50% - 10px);
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section-title {
        font-size: 18px;
        font-weight: bold;
        color: #555;
        margin-bottom: 15px;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 10px;
    }

    #personal-criteria-container,
    #kompetensi-criteria-container {
        margin-bottom: 15px;
    }

    .kriteria-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .form-group-custom {
        margin-right: 10px;
        /* Memberi jarak pada input dan button */
        flex: 1;
        /* Membuat input mengisi ruang yang tersedia */
    }

    .form-control-custom {
        border: 1px solid #d0d0d0;
        border-radius: 8px;
        padding: 10px;
        width: 100%;
        font-size: 15px;
        transition: border-color 0.3s ease;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #4CAF50;
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
    }

    .btn-danger-custom {
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 15px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-danger-custom:hover {
        background-color: #d32f2f;
    }

    .btn-add-kriteria {
        background-color: #e0e0e0;
        color: #333;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 10px;
        width: 100%;
        /* Lebar penuh */
        text-align: center;
        /* Teks tengah */
    }

    .btn-add-kriteria:hover {
        background-color: #c0c0c0;
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="section-title">Penilaian</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Penilaian</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-custom">
                <h2 class="card-title-custom">Form Penilaian</h2> {{-- Ini Nama Posisi, nanti diganti dengan data dari controller --}}

                <form action="{{ route('penilaian.store') }}" method="POST">
                    @csrf
                    <div class="row row-flex">
                        <div class="col-md-6">
                            <div class="form-section">
                                <h3 class="form-section-title">Personal</h3>
                                <div id="personal-criteria-container">
                                    <div class="kriteria-item">
                                        <div class="form-group-custom">
                                            <label>Komponen Penilaian</label>
                                            <input type="text" name="personal[]" class="form-control-custom" value="(Tidak bisa diubah)" readonly disabled>
                                        </div>
                                        {{-- Tombol hapus di-disable dan disembunyikan --}}
                                        <button type="button" class="btn-danger-custom remove-kriteria-btn" style="display:none;" disabled>
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                {{-- Tombol tambah kriteria di-disable dan disembunyikan --}}
                                <button type="button" class="btn-add-kriteria" id="add-personal-kriteria" style="display:none;" disabled>
                                    + Tambah Kriteria Lainnya
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-section">
                                <h3 class="form-section-title">Kompetensi</h3>
                                <div id="kompetensi-criteria-container">
                                    <div class="kriteria-item">
                                        <div class="form-group-custom">
                                            <label>Komponen Penilaian</label>
                                            <input type="text" name="kompetensi[]" class="form-control-custom" required>
                                        </div>
                                        <button type="button" class="btn-danger-custom remove-kriteria-btn">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="button" class="btn-add-kriteria" id="add-kompetensi-kriteria">
                                    + Tambah Kriteria Lainnya
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('penilaian.index') }}" class="btn btn-secondary-custom">Kembali</a>
                        <button type="submit" class="btn btn-primary-custom">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        function addKriteriaInput(containerId, inputName) {
            const newInputGroup = document.createElement('div');
            newInputGroup.className = 'kriteria-item';
            newInputGroup.innerHTML = `
            <div class="form-group-custom">
                <label>Komponen Penilaian</label>
                <input type="text" name="${inputName}[]" class="form-control-custom" required>
            </div>
            <button type="button" class="btn-danger-custom remove-kriteria-btn">
                <i class="bi bi-trash"></i>
            </button>
        `;
            document.getElementById(containerId).appendChild(newInputGroup);
        }

        // Hanya aktifkan tombol tambah untuk kompetensi saja
        $('#add-kompetensi-kriteria').on('click', function() {
            addKriteriaInput('kompetensi-criteria-container', 'kompetensi');
        });

        // Event hapus untuk kompetensi saja
        $(document).on('click', '.remove-kriteria-btn', function() {
            // Pastikan tombol remove hanya untuk kompetensi (input yang tidak disabled)
            if (!$(this).siblings('input').prop('disabled')) {
                $(this).closest('.kriteria-item').remove();
            }
        });
    });
</script>
@endpush