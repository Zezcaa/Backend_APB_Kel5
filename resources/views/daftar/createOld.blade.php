@extends('layouts.app')

@section('title', 'Pendaftaran Pasien Lama')

@section('content')
<div class="container mt-5" style="padding-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-4" style="background-color: #f8f9fa; border-radius: 15px;">
                <h1 class="title-underline text-center mb-5" style="font-size: 2.5rem; font-weight: 700; color: #3399ff;">Pendaftaran Pasien Lama</h1>

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert" style="border-radius: 10px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('patients.storeOld') }}" method="POST">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="name" class="form-label" style="font-weight: 500;">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Masukkan nama lengkap" value="{{ old('name') }}">
                    </div>

                    <!-- Nomor Rekam Medis -->
                    <div class="mb-3">
                        <label for="medical_record_number" class="form-label" style="font-weight: 500;">Nomor Rekam Medis</label>
                        <input type="text" class="form-control" id="medical_record_number" name="medical_record_number" readonly value="{{ old('medical_record_number') }}">

                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5 py-3 rounded-pill" style="font-weight: 600;">Selanjutnya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;

        if (name.length >= 1) {
            // Kirim request ke backend untuk cari pasien berdasarkan nama
            fetch(`/search-patient?name=${encodeURIComponent(name)}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);  // Cek data yang diterima
                    if (data.medical_record_number) {
                        // Populate first matching patient medical record number
                        document.getElementById('medical_record_number').value = data.medical_record_number;
                    } else {
                        document.getElementById('medical_record_number').value = '';
                    }

                    // Optional: Handle multiple results
                    if (data.patients && data.patients.length > 1) {
                        // Display a dropdown of results or message for multiple patients found
                        alert("Multiple patients found. Please select the correct one.");
                    }
                })
                .catch(error => {
                    console.error('Error fetching patient:', error);
                });
        } else {
            document.getElementById('medical_record_number').value = '';
        }
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
        border-radius: 15px;
        padding: 40px;
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    }
    .title-underline {
        text-decoration: underline;
        color: #3399ff;
    }
    .btn-primary {
        background-color: #3399ff;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #3399ff;
        color: white;
    }
    .form-label {
        font-weight: 500;
    }
    .form-select, .form-control {
        border-radius: 10px;
    }
    @media (max-width: 767px) {
        .card {
            padding: 30px;
        }
        .btn-lg {
            font-size: 1.1rem;
            padding: 12px 25px;
        }
        .container {
            margin-top: 40px;
        }
    }
</style>
@endsection
