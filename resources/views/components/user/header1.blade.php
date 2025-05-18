<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Kegiatanku</title>

    <!-- Favicon -->
    <!-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> -->

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
        rel="stylesheet" />

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
        rel="stylesheet" />

    <!-- Core CSS -->
    <link href="{{ asset('user/css/styles.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom w-100">
        <div
            class="container-fluid px-4 d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <a
                class="navbar-brand d-flex align-items-center text-decoration-none"
                href="#">
                <img src="{{ asset('user/assets/img/logo.png') }}" alt="Smart Internship" height="40" />
            </a>

            <!-- Menu items -->
            <div class="d-flex align-items-center">
                <a class="nav-link fw-bold text-dark mx-3" href="#">Beranda</a>
                <a class="nav-link fw-bold text-dark mx-3" href="#">Posisi</a>
                <a class="nav-link fw-bold text-dark mx-3" href="#">Kegiatanku</a>

                <!-- Notification -->
                <div class="position-relative mx-3">
                    <a href="#" class="text-dark position-relative">
                        <i class="bi bi-bell fs-5"></i>
                        <span
                            class="position-absolute badge rounded-pill bg-danger badge-notif">1</span>
                    </a>
                </div>

                <!-- User Dropdown -->
                <div class="dropdown ms-3">
                    <a
                        class="user-badge d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        href="#"
                        id="userDropdown"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span class="fw-bold me-2">MP</span>
                        <i class="bi bi-list fs-5"></i>
                    </a>

                    <ul
                        class="dropdown-menu dropdown-menu-end shadow"
                        aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="#"><i class="fas fa-user me-2 text-secondary"></i>Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"><i class="fas fa-key me-2 text-secondary"></i>Ganti Kata
                                Sandi</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i>Keluar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom Script -->
    <script src="js/scripts.js"></script>

</body>

</html>