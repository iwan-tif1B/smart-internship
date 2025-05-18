<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Landing Page</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Bootstrap icons-->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
    rel="stylesheet"
    type="text/css" />
  <!-- Google fonts-->
  <link
    href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic"
    rel="stylesheet"
    type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/home/home.css" rel="stylesheet" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
    rel="stylesheet" />
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

  <!-- Bootstrap Icons CDN -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    rel="stylesheet" />
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
        <!-- <img src="{{asset('home_img/img/logo.png')}}" alt="Smart Internship" height="40" /> -->
        <img src="{{ asset('img/logo_red.png') }}" alt="Smart Internship" height="40" />
      </a>

      <!-- Menu items -->
      <div class="d-flex align-items-center">
        <a class="nav-link fw-bold text-dark mx-3" href="#">Beranda</a>
        <a class="nav-link fw-bold text-dark mx-3" href="#">Posisi</a>
        <a
          class="btn btn-danger text-white fw-bold align-items-right btn-sm"
          href="signin">
          <i class="bi bi-person me-2"></i> Masuk ke akun
        </a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <header class="masthead position-relative">
    <div class="overlay"></div>
    <div class="container position-relative">
      <div class="row justify-content-start align-items-center vh-10">
        <div class="col-md-8 text-white">
          <!-- Page heading -->
          <h1 class="fw-bold">
            <span class="text-danger">Garuda</span> Smart <br />
            Internship
          </h1>
          <p class="lead">
            Jelajahi serangkaian pengalaman berkesan dan bermakna melalui
            program Garuda Smart Internship!
          </p>
          <!-- Button Daftar -->
          <a href="register" class="btn btn-danger btn-sm fw-bold px-5">
            <i class="fa-solid fa-right-to-bracket me-2"></i>Daftar</a>
        </div>
      </div>
    </div>
  </header>

  <!-- Section Apa itu Garuda Smart Internship? -->
  <section class="bg-light section-spacing py-5">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-lg-4 text-center">
          <img
            src="{{ asset('img_home/img/model.png') }}"
            class="img-fluid"
            alt="Seorang peserta program Garuda Smart Internship" />
        </div>
        <div class="col-lg-8 custom-spacing">
          <h1 class="custom-title">
            Apa itu
            <b class="text-danger">Garuda Smart <br />Internship?</b>
          </h1>
          <p class="custom-text">
            Garuda Smart Internship merupakan peluang magang yang ditawarkan
            untuk siswa dan mahasiswa yang ingin meraih pengalaman magang yang
            bermutu dan berkesan. Program ini dirancang untuk memberikan
            kesempatan kepada peserta magang untuk mengembangkan pengetahuan,
            keterampilan, dan wawasan praktis dalam lingkungan kerja. Dengan
            mendaftar pada program ini, peserta magang dapat memperoleh
            pengalaman yang positif dan berharga, memberikan kontribusi secara
            efektif dalam dunia profesional, serta membangun dasar yang kokoh
            untuk karir masa depan mereka.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Section Manfaat Magang -->
  <section class="benefits-section text-center">
    <div class="container">
      <h1 class="fw-bold text-white text-center mb-4">
        Apa Saja Manfaat Magang di <br />
        Garuda Cyber Indonesia?
      </h1>
      <div class="row">
        <!-- Kartu 1: Soft Skill -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="benefit-card">
            <img
              src="{{ asset('img_home/icons/1.png') }}"
              alt="Soft Skill"
              class="benefit-icon" />
            <h4>
              Penyempurnaan <br />
              Soft Skill
            </h4>
            <p>
              Kerja tim, adaptabilitas, dan kemampuan berkomunikasi secara
              efektif.
            </p>
          </div>
        </div>
        <!-- Kartu 2: Peluang Kerja -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="benefit-card">
            <img
              src="{{ asset('img_home/icons/2.png') }}"
              alt="Peluang Kerja"
              class="benefit-icon" />
            <h4>Peluang Kerja</h4>
            <p>Magang yang menjanjikan peluang karir di dunia profesional.</p>
          </div>
        </div>
        <!-- Kartu 3: Referensi Karir -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="benefit-card">
            <img
              src="{{ asset('img_home/icons/3.png') }}"
              alt="Referensi Karir"
              class="benefit-icon" />
            <h4>
              Referensi Karir <br />
              Masa Depan
            </h4>
            <p>
              Memberikan referensi yang kuat saat memasuki dunia kerja setelah
              lulus.
            </p>
          </div>
        </div>
        <!-- Kartu 4: Sertifikat -->
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="benefit-card">
            <img
              src="{{ asset('img_home/icons/4.png') }}"
              alt="Sertifikat"
              class="benefit-icon" />
            <h4>Sertifikat</h4>
            <p>
              Raihan sertifikat sebagai bentuk penghargaan atas pencapaian
              selama magang.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ-->
  <section class="faq-section">
    <div class="container">
      <h1 class="faq-title">Pertanyaan Umum</h1>
      <div class="faq-item">
        <p>Bagaimana cara registrasi akun Garuda Smart Internship?</p>
        <i class="bi bi-arrow-right-circle-fill"></i>
      </div>
      <hr />
      <div class="faq-item">
        <p>
          Bagaimana cara mengajukan magang di sistem Garuda Smart Internship?
        </p>
        <i class="bi bi-arrow-right-circle-fill"></i>
      </div>
      <hr />
      <div class="faq-item">
        <p>
          Apakah saya bisa mendaftar lebih dari 1 posisi dalam periode yang
          sama di sistem Garuda Smart Internship?
        </p>
        <i class="bi bi-arrow-right-circle-fill"></i>
      </div>
      <hr />
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <!-- Bagian Atas Footer -->
      <div class="footer-content">
        <!-- Kiri (Logo & Alamat) -->
        <div class="footer-left">
          <div class="footer-logo">
            <img src="{{ asset('img_home/icons/logofooter.png') }}" alt="Smart Internship" />
          </div>
          <p class="footer-address">
            JL. HR. Soebrantas, Sidomulyo Bar.,<br />
            Kec. Tampan, Kota Pekanbaru,<br />
            Riau 28293
          </p>
        </div>

        <!-- Kanan (Kontak) -->
        <div class="footer-right">
          <h3>Kontak</h3>
          <p>
            <a href="mailto:admin@garudacyber.co.id">admin@garudacyber.co.id</a><br />
            <a href="tel:08117674727">0811-767-4727</a>
          </p>
        </div>
      </div>

      <!-- Garis Pemisah -->
      <hr />

      <!-- Bawah Footer -->
      <div class="footer-bottom">
        <p>&copy; 2025 PT. Garuda Cyber Indonesia™</p>
        <div class="footer-social">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-tiktok"></i></a>
          <a href="#"><i class="bi bi-twitter"></i></a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
  <!-- * *                               SB Forms JS                               * *-->
  <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
  <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>