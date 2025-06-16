<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HOMEPAGE</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    /* Global */
    html, body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
      scroll-behavior: smooth;
      scroll-padding-top: 100px;
    }

    body > main {
      flex: 1;
    }

    /* Header & Footer */
    .custom-header, .custom-footer {
      background-color: #1a8cff;
      color: #fff;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .custom-header .navbar-light .navbar-nav .nav-link:hover {
      color: #000;
    }

    footer {
      background-color: #007bff;
      color: #fff;
      text-align: center;
      padding: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      position: relative;
      width: 100%;
    }

    /* Section */
    #text-intro-section {
      height: 90vh;
    }

    .container.custom-container {
      height: 80%;
    }

    .caption {
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: center;
      padding-left: 20px;
      color: #fff;
    }

    #about, #service, #contact {
      padding-top: 100px;
      padding: 20px;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    #about {
      text-align: center;
    }

    #content-about {
      background-color: #3399ff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      max-width: 1000px;
      color: white;
      margin: 0 auto;
      width: 90%;
    }

    .main-content {
      min-height: 50vh;
      background-color: #ffffff;
      color: #333;
      padding-top: 15vh;
      padding-bottom: 5vh;
    }

    .card img {
      height: 200px;
      object-fit: cover;
      width: 100%;
    }

    /* Contact Section */
    #contact {
      background-color: #3399ff;
      color: #fff;
    }

    /* Form */
    .form-container form {
      background-color: transparent;
      padding: 20px;
      border-radius: 5px;
      max-width: 500px;
      margin: 0 auto;
      color: #fff;
    }

    .form-container form h4 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-container form input[type="text"],
    .form-container form input[type="email"],
    .form-container form textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: none;
      border-radius: 3px;
      background-color: #fff;
      color: #000;
    }

    .form-container form input::placeholder,
    .form-container form textarea::placeholder {
      color: rgba(0,0,0,0.5);
    }

    .form-container form button[type="submit"] {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 3px;
      background-color: #fff;
      color: #1a8cff;
      font-weight: bold;
      text-transform: uppercase;
      cursor: pointer;
    }

    .form-container form button[type="submit"]:hover {
      background-color: #0055aa;
      color: #fff;
    }

    /* Map */
    #map {
      border-radius: 15px;
      overflow: hidden;
      height: 70vh;
    }

    iframe {
      width: 70%;
      height: 70%;
      border: 0;
    }

    /* Custom Dropdown */
    .custom-profile-dropdown {
      min-width: 250px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .custom-profile-dropdown a {
      padding: 10px 5px;
      transition: background-color 0.2s;
      border-radius: 10px;
    }

    .custom-profile-dropdown a:hover {
      background-color: #f0f0f0;
    }
  </style>

</head>
<body>

<header id="header" class="custom-header sticky-top">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('assets/img/LOGOKU.jpg') }}" alt="HealthyCare Logo" width="50" height="50">
        <span class="ms-2" style="">HealthyCare</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">Beranda</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#about">Tentang Kami</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#service">Fasilitas & Layanan</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#contact">Kontak</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Lainnya
            </a>
            <div class="dropdown-menu dropdown-menu-end p-3 custom-profile-dropdown" aria-labelledby="navbarDropdown">
              <a class="d-flex align-items-center mb-2 text-decoration-none text-dark" href="{{ route('patients.index') }}">
                <i class="bi bi-person-plus fs-4 me-3"></i> Daftar
              </a>
              <a class="d-flex align-items-center mb-2 text-decoration-none text-dark" href="{{ route('dokter.dashboard') }}">
                <i class="bi bi-calendar-check fs-4 me-3"></i> Jadwal Dokter
              </a>
              @if(auth()->check() && auth()->user()->role === 'patient')
              <a class="d-flex align-items-center mb-2 text-decoration-none text-dark" href="{{ route('rooms.index') }}">
                <i class="bi bi-house-door fs-4 me-3"></i> Reservasi Kamar
              </a>
              @endif
            </div>
          </li>

          @if(auth()->check())
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ asset('assets/img/icon.jpg') }}" alt="Profile Icon" width="30" height="30" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-end p-3 custom-profile-dropdown" aria-labelledby="profileDropdown">
              <a class="d-flex align-items-center mb-2 text-decoration-none text-dark" href="{{ route('riwayat.kunjungan') }}">
                <i class="bi bi-clock-history fs-4 me-3"></i> Riwayat Kunjungan
              </a>
              <a class="d-flex align-items-center mb-2 text-decoration-none text-dark" href="{{ route('ubah.password') }}">
                <i class="bi bi-lock fs-4 me-3"></i> Ganti Password
              </a>
              <a class="d-flex align-items-center mb-2 text-decoration-none text-dark" href="{{ route('pengaturan.notif') }}">
                <i class="bi bi-bell fs-4 me-3"></i> Pengaturan Notifikasi
              </a>
              <a class="d-flex align-items-center mb-2 text-decoration-none text-dark" href="{{ route('pengaturan.privasi') }}">
                <i class="bi bi-shield-lock fs-4 me-3"></i> Pengaturan Privasi
              </a>
              <a class="d-flex align-items-center mb-2 text-decoration-none text-dark" href="{{ route('kritik.saran') }}">
                <i class="bi bi-chat-dots fs-4 me-3"></i> Kritik dan Saran
              </a>
              <div class="dropdown-divider"></div>
              <a class="d-flex align-items-center text-decoration-none text-danger" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-right fs-4 me-3"></i> Logout
              </a>
            </div>
          </li>
          @else
          <li class="nav-item">
            <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
          </li>
          @endif

        </ul>
      </div>
    </div>
  </nav>
</header>


@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<main>
  @yield('content')
</main>


<footer class="custom-footer text-center py-4">
  <p>&copy; 2024 HealthyCare. All rights reserved.</p>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
