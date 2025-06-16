@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Dokter</h2>

<!-- Tombol Tambah Dokter -->
<div class="mb-6">
    <a href="{{ route('dokter.create') }}"
       class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded shadow">
        + Tambah Dokter
    </a>
</div>

<div class="space-y-6">
@foreach ($doctors as $doctor)
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-start justify-between">
            <div>
                <h3 class="text-xl font-semibold text-blue-700">{{ $doctor->name }}</h3>
                <p class="text-gray-600 mt-1"><strong>Spesialisasi:</strong> {{ $doctor->speciality }}</p>
            </div>
            <div class="space-x-2">
                <a href="{{ route('dokter.edit', $doctor->id) }}"
                   class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                    ✏️ Edit
                </a>
                <form action="{{ route('dokter.destroy', $doctor->id) }}" method="POST" class="inline-block"
                      onsubmit="return confirm('Yakin ingin menghapus dokter ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                        🗑️ Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-4">
            <h4 class="text-md font-semibold text-gray-700 mb-2">Jadwal Praktek</h4>
            @if($doctor->schedules->isEmpty())
                <p class="text-sm text-red-500">Tidak ada jadwal praktek untuk dokter ini.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-left px-4 py-2 border-b">Hari</th>
                                <th class="text-left px-4 py-2 border-b">Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doctor->schedules as $schedule)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border-b">{{ $schedule->day }}</td>
                                    <td class="px-4 py-2 border-b">{{ $schedule->time }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endforeach
</div>
@endsection
