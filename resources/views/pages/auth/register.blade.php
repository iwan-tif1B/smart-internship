@extends('layouts.auth')

@section('title', 'Daftar')

@push('style')
<!-- Bootstrap & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<style>
    body {
        background-color: #f5f7fa;
    }

    .register-modal {
        width: 100%;
        max-width: 400px;
    }

    .logo {
        max-width: 120px;
        margin-bottom: 20px;
    }
</style>
@endpush

@section('main')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="register-modal text-center p-4 shadow bg-white rounded">
        <!-- Logo -->
        <img src="{{ asset('img/logo_red.png') }}" alt="Smart Internship" class="mb-2 img-fluid logo">

        <!-- Judul -->
        <h4 class="fw-bold mb-4 text-start text-black">Daftar</h4>

        <!-- Form Register -->
        <form method="POST" action="#">
            @csrf
            <!-- Nama -->
            <div class="mb-3 text-start">
                <label for="name" class="form-label">Nama</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>

            <!-- Email -->
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email aktif" required>
            </div>

            <!-- Password -->
            <div class="mb-3 text-start">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan kata sandi" required>
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-3 text-start">
                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi kata sandi" required>
            </div>

            <!-- Tombol -->
            <div class="d-grid mb-3">
                <button type="buttton" class="testing_aja btn btn-danger w-100" onclick="daftar()">Daftar</button>
            </div>

            <!-- Sudah punya akun -->
            <p class="text-center mt-3">
                Sudah memiliki akun?
                <a href="{{ url('/') }}" class="text-danger fw-bold text-decoration-none">Masuk</a>
            </p>

        </form>
    </div>
</div>
<script>
    function daftar() {
        event.preventDefault();

        $.ajax({
            url: "{{ route('create_new_account.store') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                name: $("#name").val(),
                email: $("#email").val(),
                password: $("#password").val(),
                password_confirmation: $("#password_confirmation").val()
            },
            success: function(response) {
                // Swal.fire({
                //     icon: 'success',
                //     title: 'Berhasil!',
                //     text: response.message,
                //     confirmButtonColor: '#3085d6',
                // }).then(() => {
                window.location.href = '/signin'; // Redirect jika perlu
                // });
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let message = "";
                for (let key in errors) {
                    message += `• ${errors[key][0]}<br>`;
                }

                // Swal.fire({
                //     icon: 'error',
                //     title: 'Gagal mendaftar!',
                //     html: message,
                //     confirmButtonColor: '#d33',
                // });
            }
        });
    }
</script>

@endsection