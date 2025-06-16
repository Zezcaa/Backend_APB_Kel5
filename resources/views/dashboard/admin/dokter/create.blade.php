@extends('layouts.admin')

@section('title', 'Tambah Dokter')

@section('content')

<div class="full-wrapper d-flex justify-content-center align-items-center" style="padding-top: 60px;">
    <div class="card p-5 shadow" style="width: 100%; max-width: 700px; border-radius: 20px;">
        <h1 style="font-size: 28px; font-weight: bold; text-align: center; margin-bottom: 24px; color: #3399ff;">
            Tambah Dokter dan Jadwal
        </h1>
        <form action="{{ route('dokter.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username dokter" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi password" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nama Dokter</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama dokter" required>
            </div>

            <div class="mb-3">
                <label for="speciality" class="form-label">Spesialisasi</label>
                <input type="text" name="speciality" id="speciality" class="form-control" placeholder="Masukkan spesialisasi dokter" required>
            </div>

            <div class="mb-3">
                <label for="clinic_id" class="form-label">Klinik</label>
                <select name="clinic_id" id="clinic_id" class="form-control" required>
                    <option value="" disabled selected>Pilih Klinik</option>
                    @foreach ($clinics as $clinic)
                        <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="day" class="form-label">Hari Praktik</label>
                <input type="text" name="day" id="day" class="form-control" placeholder="Masukkan hari praktik" required>
            </div>

            <div class="mb-3">
                <label for="time" class="form-label">Waktu Praktik</label>
                <input type="text" name="time" id="time" class="form-control" placeholder="Masukkan waktu praktik" required>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill" style="background-color: #3399ff; border: none;">
                    Tambah Dokter
                </button>
            </div>
        </form>
    </div>

</div>

<style>
  html, body {
    height: auto;
    margin: 0;
    padding: 0;
    background-color: #f4f6f8;
  }

  .full-wrapper {
    display: flex;
    justify-content: center;
    padding-top: 10px;
    align-items: flex-start;
    padding: 20px 0;
  }

  .card {
    background-color: #f8f9fa;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    margin-top: -40px;
    transform: translateY(-30px);
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
  }
</style>

@endsection
