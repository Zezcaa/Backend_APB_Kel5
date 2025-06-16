<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Ini yang bener, bukan .js -->
    <style>
        .menu-link {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            color: #495057;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        .menu-link:hover {
            background-color: #f8f9fa;
            color: #212529;
        }
        .menu-icon {
            font-size: 20px;
            margin-right: 12px;
        }
        .menu-text {
            flex-grow: 1;
        }
        .menu-chevron {
            font-size: 16px;
            color: #adb5bd;
        }
    </style>
</head>
<body class="bg-white">
    <div class="container mt-5" style="max-width: 400px;">
        <div class="d-flex align-items-center mb-4">
            <div class="me-3">
                <div class="bg-secondary rounded-circle" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-person text-white" style="font-size: 30px;"></i>
                </div>
            </div>
            <div>
                <h5 class="mb-1">Nama Pengguna</h5>
                <small class="text-muted">ID Pasien: 12345678</small><br>
                <small class="text-muted">Tanggal Lahir: 01 Jan 1990</small>
            </div>
        </div>

        <hr>

        <div class="list-group">
            <a href="{{ route('riwayat.kunjungan') }}" class="menu-link">
                <i class="bi bi-clock-history menu-icon"></i>
                <span class="menu-text">Riwayat</span>
                <i class="bi bi-chevron-right menu-chevron"></i>
            </a>
            <a href="{{ route('ubah.password') }}" class="menu-link">
                <i class="bi bi-lock menu-icon"></i>
                <span class="menu-text">Ganti Password</span>
                <i class="bi bi-chevron-right menu-chevron"></i>
            </a>
            <a href="{{ route('pengaturan.notif') }}" class="menu-link">
                <i class="bi bi-bell menu-icon"></i>
                <span class="menu-text">Pengaturan Notifikasi</span>
                <i class="bi bi-chevron-right menu-chevron"></i>
            </a>
            <a href="{{ route('pengaturan.privasi') }}" class="menu-link">
                <i class="bi bi-shield-lock menu-icon"></i>
                <span class="menu-text">Pengaturan Privasi</span>
                <i class="bi bi-chevron-right menu-chevron"></i>
            </a>
            <a href="{{ route('kritik.saran') }}" class="menu-link">
                <i class="bi bi-chat-dots menu-icon"></i>
                <span class="menu-text">Kritik dan Saran</span>
                <i class="bi bi-chevron-right menu-chevron"></i>
            </a>
            <a href="{{ route('logout') }}" class="menu-link text-danger">
                <i class="bi bi-box-arrow-right menu-icon"></i>
                <span class="menu-text">Logout</span>
                <i class="bi bi-chevron-right menu-chevron"></i>
            </a>
        </div>
    </div>

</body>
</html>
