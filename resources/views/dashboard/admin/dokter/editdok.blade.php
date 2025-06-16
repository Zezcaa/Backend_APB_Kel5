@extends('layouts.admin')

@section('title', 'Edit Dokter')

@section('content')

<div class="full-wrapper d-flex justify-content-center align-items-center" style="padding-top: 60px;">
    <div class="card p-5 shadow" style="width: 100%; max-width: 700px; border-radius: 20px;">
        <h1 style="font-size: 28px; font-weight: bold; text-align: center; margin-bottom: 24px; color: #3399ff;">
            Edit Dokter
        </h1>
        <form action="{{ route('dokter.update', $doctor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Dokter</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $doctor->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="speciality" class="form-label">Spesialisasi</label>
                <input type="text" name="speciality" id="speciality" class="form-control" value="{{ old('speciality', $doctor->speciality) }}" required>
            </div>

            <div class="mb-3">
                <label for="clinic_id" class="form-label">Klinik</label>
                <select name="clinic_id" id="clinic_id" class="form-control" required>
                    @foreach ($clinics as $clinic)
                        <option value="{{ $clinic->id }}" {{ $clinic->id == $doctor->clinic_id ? 'selected' : '' }}>
                            {{ $clinic->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <h5>Jadwal Dokter Saat Ini</h5>
            @foreach ($doctor->schedules as $key => $schedule)
            <div class="mb-3 border p-3">
                <input type="hidden" name="existing_schedules[{{ $key }}][id]" value="{{ $schedule->id }}">
    
                <label class="form-label">Hari</label>
                <input type="text" name="existing_schedules[{{ $key }}][day]" class="form-control" value="{{ $schedule->day }}" required>

                <label class="form-label mt-2">Waktu</label>
                <input type="text" name="existing_schedules[{{ $key }}][time]" class="form-control" value="{{ $schedule->time }}" required>

                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="existing_schedules[{{ $key }}][delete]" value="1">
                    <label class="form-check-label text-danger">Hapus Jadwal Ini</label>
                </div>
            </div>
            @endforeach

            <h5 class="mt-4">Tambah Jadwal Baru</h5>
            <div id="new-schedules-container"></div>
            <br>
            <button type="button" class="btn btn-secondary mb-3" onclick="addSchedule()">+ Tambah Jadwal</button>

            <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
        </form>
    </div>
</div>

<!-- Script Tambah Input Jadwal -->
<script>
    let scheduleIndex = 0;

    function addSchedule() {
        const container = document.getElementById('new-schedules-container');
        const html = `
            <div class="mb-3 border p-3">
                <label class="form-label">Hari</label>
                <input type="text" name="new_schedules[${scheduleIndex}][day]" class="form-control" required>

                <label class="form-label mt-2">Waktu</label>
                <input type="text" name="new_schedules[${scheduleIndex}][time]" class="form-control" required>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        scheduleIndex++;
    }
</script>
@endsection

