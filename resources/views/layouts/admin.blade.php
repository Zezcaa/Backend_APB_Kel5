<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

  <!-- Sidebar -->
  <div class="flex">
    <aside class="w-64 h-screen bg-white shadow-md sticky top-0"> <!-- Menambahkan sticky dan top-0 -->
        <div class="p-6 flex flex-col items-center justify-center pt-12">
            <a class="navbar-brand flex flex-col items-center" href="{{ route('admin.home') }}">
                <img src="{{ asset('assets/img/LOGOKU.jpg') }}" alt="Admin Logo" width="75" height="75">
                <span class="ms-2" style="font-size: 1.70rem; font-weight: bold; color: #1D4ED8;">Admin Panel</span>
            </a>
        </div>
        <nav class="mt-6">
            <a href="{{ route('admin.home') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-200">Dashboard</a>
            <a href="{{ route('dokter.show') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-200">Lihat Semua Dokter</a>
            <a href="{{ route('admin.cekPasien') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-200">Cek Data Pasien</a> 
            <a href="{{ route('admin.kritikSaran') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-200">Kritik dan Saran</a> 
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-6 py-2 text-gray-700 hover:bg-gray-200"> Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf</form>
        </nav>
    </aside>
    <!-- Main Content -->
    <main class="flex-1 p-8">
      @yield('content')
    </main>
  </div>

</body>
</html>

<!-- id pasien -->
