@extends('layouts.admin')

@section('content')
  <div class="bg-gradient-to-r from-blue-500 to-teal-400 p-6 rounded-lg shadow-lg text-white mb-6">
    <h1 class="text-4xl font-extrabold">Welcome to Admin Dashboard</h1>
    <p class="mt-2 text-lg">Manage the hospital operations with ease</p>
  </div>

  <!-- Dashboard Overview -->
  <section class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Overview</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Total Patients Card -->
      <div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow p-6 flex items-center">
        <div class="bg-blue-100 text-blue-500 p-4 rounded-full mr-4">
          <i class="fas fa-bed fa-2x"></i>
        </div>
        <div>
          <h2 class="text-xl font-semibold text-gray-700">Total Patients</h2>
          <p class="text-2xl font-bold text-blue-600 mt-2">250</p>
        </div>
      </div>

      <!-- Active Doctors Card -->
      <div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow p-6 flex items-center">
        <div class="bg-green-100 text-green-500 p-4 rounded-full mr-4">
          <i class="fas fa-user-md fa-2x"></i>
        </div>
        <div>
          <h2 class="text-xl font-semibold text-gray-700">Active Doctors</h2>
          <p class="text-2xl font-bold text-green-600 mt-2">45</p>
        </div>
      </div>

      <!-- Pending Treatments Card -->
      <div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow p-6 flex items-center">
        <div class="bg-red-100 text-red-500 p-4 rounded-full mr-4">
          <i class="fas fa-clock fa-2x"></i>
        </div>
        <div>
          <h2 class="text-xl font-semibold text-gray-700">Pending Treatments</h2>
          <p class="text-2xl font-bold text-red-600 mt-2">10</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Patient Treatment Status -->
  <section class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Treatment Status</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Ongoing Treatment Card -->
      <div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow p-6">
        <h2 class="text-xl font-semibold text-gray-700">Ongoing Treatments</h2>
        <p class="text-2xl font-bold text-yellow-600 mt-2">15</p>
      </div>

      <!-- Completed Treatment Card -->
      <div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow p-6">
        <h2 class="text-xl font-semibold text-gray-700">Completed Treatments</h2>
        <p class="text-2xl font-bold text-green-600 mt-2">120</p>
      </div>

      <!-- Canceled Treatment Card -->
      <div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow p-6">
        <h2 class="text-xl font-semibold text-gray-700">Canceled Treatments</h2>
        <p class="text-2xl font-bold text-red-600 mt-2">5</p>
      </div>
    </div>
  </section>

  <!-- Progress Bars (Example of a dynamic section) -->
  <section class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Progress</h2>
    <div class="space-y-4">
      <div>
        <p class="font-semibold">Surgical Procedures Progress</p>
        <div class="w-full bg-gray-200 rounded-full h-2.5">
          <div class="bg-blue-500 h-2.5 rounded-full" style="width: 60%"></div>
        </div>
      </div>
      <div>
        <p class="font-semibold">Patient Recovery Status</p>
        <div class="w-full bg-gray-200 rounded-full h-2.5">
          <div class="bg-green-500 h-2.5 rounded-full" style="width: 80%"></div>
        </div>
      </div>
    </div>
  </section>
@endsection
