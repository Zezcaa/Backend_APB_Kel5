@extends('layouts.dokter')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="space-y-6">
    <!-- Welcome Message -->
    <div class="text-gray-800">
        <h2 class="text-2xl font-bold">Selamat Datang, Dr. {{ $doctor->name }}</h2>
        <p class="text-gray-600 mt-1">Berikut adalah daftar pasien Anda.</p>
    </div>

    @if ($patients->count() > 0)
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full text-sm text-left divide-y divide-gray-200">
        <thead class="bg-blue-600 text-white whitespace-nowrap">
    <tr>
        <th class="px-4 py-3 font-semibold">No</th>
        <th class="px-4 py-3 font-semibold">Nama</th>
        <th class="px-4 py-3 font-semibold">Umur</th>
        <th class="px-4 py-3 font-semibold">Gender</th>
        <th class="px-4 py-3 font-semibold">Tgl Lahir</th>
        <th class="px-4 py-3 font-semibold">Rekam Medis</th>
        <th class="px-4 py-3 font-semibold">Antrian</th>
        <th class="px-4 py-3 font-semibold">Keluhan</th>
        <th class="px-4 py-3 font-semibold">Hasil</th> {{-- Tambahkan header kolom baru --}}
    </tr>
</thead>
<tbody class="divide-y divide-gray-100 whitespace-nowrap">
    @foreach ($patients as $index => $patient)
        <tr class="hover:bg-gray-50">
            <td class="px-4 py-2">{{ $index + 1 }}</td>
            <td class="px-4 py-2">{{ $patient->name }}</td>
            <td class="px-4 py-2">{{ $patient->age }}</td>
            <td class="px-4 py-2">{{ $patient->gender }}</td>
            <td class="px-4 py-2">{{ $patient->birth_date }}</td>
            <td class="px-4 py-2">{{ $patient->medical_record_number }}</td>
            <td class="px-4 py-2">{{ $patient->queue_number }}</td>
            <td class="px-4 py-2">{{ $patient->keluhan ?? '-' }}</td>
            <td class="px-4 py-2">
    @if ($patient->hasilPeriksa)
        <button 
            onclick="openModal('modal-{{ $patient->id }}')" 
            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs"
        >
            Lihat Hasil
        </button>

        <!-- Modal -->
        <div id="modal-{{ $patient->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative">
                <button onclick="closeModal('modal-{{ $patient->id }}')" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 font-bold">&times;</button>
                <h3 class="text-xl font-semibold mb-4">Hasil Pemeriksaan</h3>
                <p><strong>Diagnosa:</strong> {{ $patient->hasilPeriksa->diagnosa }}</p>
                <p><strong>Jenis Rawat:</strong> {{ $patient->hasilPeriksa->jenis_rawat }}</p>
                <p><strong>Resep:</strong> {{ $patient->hasilPeriksa->resep }}</p>
            </div>
        </div>
    @else
        <span class="text-gray-500 text-xs">Belum ada hasil</span>
    @endif
</td>

        </tr>
    @endforeach
</tbody>

        </table>
    </div>
@else
    <div class="text-gray-600">
        <p>Tidak ada pasien yang terdaftar.</p>
    </div>
@endif
</div>

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // mencegah scroll belakang
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = 'auto'; // aktifkan scroll kembali
    }
</script>


@endsection
