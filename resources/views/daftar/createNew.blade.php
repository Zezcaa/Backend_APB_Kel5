@extends('layouts.app')

@section('title', 'Pendaftaran Pasien Baru')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-4" style="background-color: #f8f9fa; border-radius: 15px;">
                <h1 class="title-underline text-center mb-4" style="font-size: 2.5rem; font-weight: 700; color: #3399ff;">Pendaftaran Pasien Baru</h1>

                <form action="{{ route('patients.storeNew') }}" method="POST">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="name" class="form-label" style="font-weight: 500;">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Masukkan nama lengkap">
                    </div>

                    <!-- Umur -->
                    <div class="mb-3">
                        <label for="age" class="form-label" style="font-weight: 500;">Umur</label>
                        <input type="number" class="form-control" id="age" name="age" placeholder="Masukkan umur">
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-3">
                        <label for="gender" class="form-label" style="font-weight: 500;">Jenis Kelamin</label>
                        <select class="form-select" id="gender" name="gender">
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mb-3">
                        <label for="birth_date" class="form-label" style="font-weight: 500;">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date">
                    </div>

                    <!-- Tombol Submit -->
                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5 py-3 rounded-pill" style="font-weight: 600;">Selanjutnya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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

        /* Responsiveness */
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
