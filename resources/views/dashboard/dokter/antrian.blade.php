@extends('layouts.dokter')

@section('title', 'Diagnosis Pasien')

@section('content')
<div class="space-y-6">
    <div class="text-gray-800">
        <h2 class="text-2xl font-bold">Daftar Pasien untuk Diagnosis</h2>
        <p class="text-gray-600 mt-1">Silakan panggil pasien berdasarkan nomor antrian.</p>
    </div>

    @if($patients->isEmpty())
        <div class="text-gray-600">
            <p>Tidak ada pasien dalam antrian saat ini.</p>
        </div>
    @else
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full text-sm text-left divide-y divide-gray-200">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold">No. Antrian</th>
                        <th class="px-4 py-3 font-semibold">Nama Pasien</th>
                        <th class="px-4 py-3 font-semibold">Waktu Registrasi</th>
                        <th class="px-4 py-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($patients as $patient)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $patient->queue_number }}</td>
                            <td class="px-4 py-2">{{ $patient->name }}</td>
                            <td class="px-4 py-2">{{ $patient->created_at->format('H:i') }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('dokter.antrian.call', $patient->id) }}" class="inline-block px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600 transition">
                                    Panggil
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
