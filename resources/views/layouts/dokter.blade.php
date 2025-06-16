<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dokter Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white border-b px-4 py-3 flex items-center justify-between shadow-sm sticky top-0 z-50">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('assets/img/logo3.png') }}" alt="HealthyCare Logo" class="h-10 w-10 object-contain" />
            <span class="text-xl font-semibold text-blue-700">HealthyCare</span>
        </div>
    </header>

    <div class="flex flex-col md:flex-row">
        <aside class="w-64 h-[calc(100vh-60px)] bg-white shadow-md sticky top-[60px]">
            <div class="doctor-profile text-center py-6">
                <img src="{{ $doctor->photo_path ? asset('assets/img/' . $doctor->photo_path) : 'https://via.placeholder.com/150' }}"
                     alt="Photo of {{ $doctor->name }}"
                     class="mx-auto rounded-full shadow-md"
                     style="width: 120px; height: 120px; object-fit: cover;">
                <div class="doctor-name mt-3 text-blue-700 font-bold text-lg">Dr. {{ $doctor->name }}</div>
            </div>
            <nav class="mt-6">
                <a href="{{ route('dokter.dashboard') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-200">Dashboard</a>
                <a href="{{ route('dokter.antrian') }}" class="block px-6 py-2 text-gray-700 hover:bg-gray-200">Antrian</a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-6 py-2 text-gray-700 hover:bg-gray-200"> Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf</form>

            </nav>
        </aside>
        <main class="flex-1 p-4 sm:p-6 overflow-x-auto">
            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("hidden");
        }
    </script>
</body>
</html>
