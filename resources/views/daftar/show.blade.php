@extends('layouts.app')

@section('title', 'Nomor Antrean')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-5" style="background-color: #f8f9fa; border-radius: 15px;">
                <h1 class="title-underline text-center mb-4" style="font-size: 2.5rem; font-weight: 700; color: #3399ff;">Nomor Antrean</h1>

                <!-- Nomor Antrean -->
                <div class="text-center mb-4">
                    <h4 style="font-weight: 500; font-size: 1.5rem;">Nomor Antrean Anda: 
                        <span style="font-weight: 700; color: #3399ff; font-size: 2rem;">{{ $patient->queue_number }}</span>
                    </h4>
                    <p style="font-size: 1rem; color: #6c757d;">Terima kasih telah mendaftar sebagai pasien di HealthyCare. Anda dapat mengikuti nomor antrean untuk melanjutkan proses pengobatan.</p>
                </div>

                <!-- Tombol kembali ke halaman utama -->
                <div class="text-center">
                    <a href="{{ route('index') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill" style="font-weight: 600;">Kembali ke Halaman Utama</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <style>
        .container {
            margin-top: 60px;
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

        .text-center p {
            font-size: 1rem;
            color: #6c757d;
        }

        /* Responsiveness */
        @media (max-width: 767px) {
            .card {
                padding: 30px;
            }

            .btn-lg {
                font-size: 1rem;
                padding: 12px 25px;
            }

            .container {
                margin-top: 40px;
            }
        }
    </style>
@endsection
