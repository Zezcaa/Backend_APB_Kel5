@extends('layouts.app')

@section('content')
<main class="main-content d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <!-- Logo di kiri -->
      <div class="col-md-6 text-center mb-4 mb-md-0">
        <img src="{{ asset('assets/img/logo.jpeg') }}" alt="HealthyCare Logo" class="img-fluid" style="max-width: 80%; height: auto;">
      </div>

      <!-- Form login di kanan -->
      <div class="col-md-5">
        <div class="card shadow-lg" style="border-radius: 20px; padding: 30px;">
          <h2 class="text-center" style="font-size: 2.5rem; font-weight: bold; color: #0066cc; margin-bottom: 20px;">Login</h2>

          @if ($errors->any())
            <div class="alert alert-danger" role="alert" style="border-radius: 10px; padding: 15px; background-color: #f8d7da; color: #721c24;">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="username" class="form-label" style="font-weight: 500;">Username</label>
              <input type="text" class="form-control" id="username" name="username" required placeholder="Masukkan username" value="{{ old('username') }}" autofocus>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label" style="font-weight: 500;">Password</label>
              <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password">
            </div>

            <div class="d-flex justify-content-center mt-4">
              <button type="submit" class="btn btn-primary btn-lg px-5 py-3 rounded-pill" style="font-weight: 600;">Login</button>
            </div>
          </form>

          <div class="text-center mt-4" style="font-weight: 500;">
            Belum punya akun? 
            <a href="{{ route('register.patient') }}" style="color: #0066cc; font-weight: 700; text-decoration: none;">
              Daftar disini
            </a>
          </div>

        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@section('styles')
    <style>
        .container {
            margin-top: 0;
            width: 100%;
        }

        .card {
            background-color: #f8f9fa;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #0066cc; /* Biru */
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #005bb5; /* Biru lebih gelap */
            color: white;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control {
            border-radius: 10px;
        }

        /* Responsiveness */
        @media (max-width: 767px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .col-md-6 {
                margin-bottom: 30px;
            }

            .card {
                padding: 20px;
                width: 100%;
            }

            .img-fluid {
                max-width: 70%;
            }
        }
    </style>
@endsection
