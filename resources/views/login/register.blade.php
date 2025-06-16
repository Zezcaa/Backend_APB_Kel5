@extends('layouts.app')

@section('content')
<main class="main-content d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <!-- Logo -->
      <div class="col-md-6 text-center mb-4 mb-md-0">
        <img src="{{ asset('assets/img/logo.jpeg') }}" alt="HealthyCare Logo" class="img-fluid" style="max-width: 80%; height: auto;">
      </div>

      <!-- Form Registrasi -->
      <div class="col-md-5">
        <div class="card shadow-lg" style="border-radius: 20px; padding: 30px;">
          <h2 class="text-center" style="font-size: 2.5rem; font-weight: bold; color: #0066cc; margin-bottom: 20px;">Daftar Akun</h2>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('register.patient.submit') }}">
            @csrf
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" required value="{{ old('username') }}">
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Kata Sandi</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="d-flex justify-content-center mt-4">
              <button type="submit" class="btn btn-primary btn-lg px-5 py-3 rounded-pill">Daftar</button>
            </div>
          </form>

          <div class="text-center mt-4">
            Sudah punya akun? <a href="{{ route('login') }}" style="color: #0066cc; font-weight: 700;">Masuk di sini</a>
          </div>

        </div>
      </div>
    </div>
  </div>
</main>
@endsection
