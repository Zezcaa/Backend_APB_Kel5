@extends('layouts.app')

@section('title', 'Pilih Poli dan Dokter')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card shadow p-5 rounded-4">
                <h1 class="text-center mb-5 title-underline">Pilih Poli dan Dokter</h1>

                <!-- Menampilkan pesan error jika ada -->
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Pilih Poli dan Dokter -->
                <form action="{{ route('patients.storePoli', ['patient' => $patient->id]) }}" method="POST">
                    @csrf

                    <!-- Pilih Poli -->
                    <div class="mb-4">
                        <label for="poli" class="form-label">Pilih Poli</label>
                        <select class="form-select" id="poli" name="clinic_id" required>
                            <option value="" disabled selected>Pilih poli</option>
                            @foreach ($polies as $poli)
                            <option value="{{ $poli->id }}">{{ $poli->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilih Dokter -->
                    <div class="mb-4">
                        <label for="doctor" class="form-label">Pilih Dokter</label>
                        <select class="form-select" id="doctor" name="doctor_id" required>
                            <option value="" disabled selected>Pilih dokter</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="keluhan">Keluhan</label>
                        <textarea name="keluhan" class="form-control" rows="3">{{ old('keluhan') }}</textarea>
                    </div>

                    <br>

                    <!-- Tombol Submit -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg px-5 py-3 rounded-pill">Daftar Pasien</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Javascript untuk Filtering Dokter -->
<script>
   const doctors = @json($doctors);
const doctorSelect = document.getElementById('doctor');
const poliSelect = document.getElementById('poli');

poliSelect.addEventListener('change', function() {
    const selectedPoliId = this.value;

    doctorSelect.innerHTML = '<option value="" disabled selected>Pilih dokter</option>';

    const filteredDoctors = doctors.filter(doctor => doctor.clinic_id == selectedPoliId);

    console.log(filteredDoctors); // Debugging untuk melihat dokter yang sesuai poli

    filteredDoctors.forEach(doctor => {
        const option = document.createElement('option');
        option.value = doctor.id;
        option.textContent = doctor.name;
        doctorSelect.appendChild(option);
    });
});

</script>
@endsection

@section('styles')
<style>
    .container {
        margin-top: 80px;
    }

    .card {
        background-color: #f8f9fa;
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .title-underline {
        font-size: 2.5rem;
        font-weight: 700;
        text-decoration: underline;
        color: #3399ff; /* warna merah elegan */
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-select,
    .form-control {
        border-radius: 12px;
        padding: 12px;
        font-size: 1rem;
    }

    .form-select:focus,
    .form-control:focus {
        border-color: #3399ff;
        box-shadow: 0 0 5px rgba(51, 153, 255, 0.5);
    }

    .alert-danger {
        border-radius: 10px;
        padding: 15px;
        background-color: #f8d7da;
        color: #721c24;
    }

    .btn-primary {
        background-color: #3399ff;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #287bcc;
        color: white;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .card {
            padding: 30px;
        }

        .btn-lg {
            font-size: 1.1rem;
            padding: 12px 25px;
        }
    }
</style>
@endsection
