@extends('layouts.dokter')

@section('title', 'Diagnosis Pasien')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Diagnosis untuk: <span class="text-blue-600">{{ $patient->name }}</span></h2>

    <div class="mb-4 text-gray-700">
        <p><strong>Umur:</strong> {{ $patient->age }} tahun</p>
        <p><strong>Gender:</strong> {{ $patient->gender }}</p>
        <p><strong>Keluhan:</strong> {{ $patient->keluhan ?? '-' }}</p>
    </div>

    <hr class="my-4">

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dokter.storeHasil', $patient->id) }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="diagnosa" class="block font-medium text-gray-700">Diagnosa:</label>
            <textarea name="diagnosa" id="diagnosa" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400" required>{{ old('diagnosa') }}</textarea>
        </div>

        <div>
            <label for="jenis_rawat" class="block font-medium text-gray-700">Jenis Rawat:</label>
            <select name="jenis_rawat" id="jenis_rawat" required class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400">
                <option value="">-- Pilih --</option>
                <option value="Rawat Jalan" {{ old('jenis_rawat') == 'Rawat Jalan' ? 'selected' : '' }}>Rawat Jalan</option>
                <option value="Rawat Inap" {{ old('jenis_rawat') == 'Rawat Inap' ? 'selected' : '' }}>Rawat Inap</option>
            </select>
        </div>

        <div>
            <label for="resep" class="block font-medium text-gray-700">Resep:</label>
            <textarea name="resep" id="resep" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-400" required>{{ old('resep') }}</textarea>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                Simpan Diagnosis
            </button>
        </div>
    </form>
</div>
@endsection
