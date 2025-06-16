@extends('layouts.app')

@section('title', 'Jadwal Dokter')

@section('content')
    <br>
    <h3 class="text-center" style="color: #3399ff;">JADWAL DOKTER</h3>
    <br>
    <div class="d-flex justify-content-center" style="gap: 10px; background-color: #3399ff; padding: 50px; flex-direction: column; align-items: center;">
        <div class="row w-100" style="gap: 80px;">
            <!-- Pilih Dokter -->
            <div class="col-md-5 col-12 mb-3">
                <h6 style="color: #FFFFFF;">Pilih Dokter</h6>
                <select id="dokterSelect" onchange="fetchDoctorDetails()" class="form-select" style="font-size: 16px;">
                    <option value="" disabled selected>-Pilih Dokter-</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Pilih Klinik -->
            <div class="col-md-5 col-12 mb-3">
                <h6 style="color: #FFFFFF;">Pilih Klinik</h6>
                <select id="klinikSelect" onchange="fetchClinicDetails()" class="form-select" style="font-size: 16px;">
                    <option value="" disabled selected>-Pilih Klinik-</option>
                    @foreach($clinics as $clinic)
                        <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <br>
    <div class="container d-flex">
        <div class="d-inline-flex" style="background-color: #3399ff; color: white; padding: 10px; border-radius: 4px; width: 10000px;">
            Spesialis
        </div>
    </div>
    <br>
    <div class="container">
        <div class="title-underline">List Dokter</div>
    </div>

    <!-- Div untuk menampilkan detail dokter dan klinik -->
    <div class="container mt-4" id="detailsContainer"></div>

<script>
    const allDoctors = @json($doctors);

    document.addEventListener('DOMContentLoaded', () => {
        displayAllDoctors(allDoctors);
    });
    function displayAllDoctors(doctors) {
        const detailsDiv = document.getElementById('detailsContainer');
        detailsDiv.innerHTML = '';

        doctors.forEach(doctor => {
            const div = document.createElement('div');
            div.classList.add('card', 'mb-4');
            div.innerHTML = `
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="${doctor.photo_path ? 'assets/img/' + doctor.photo_path : 'https://via.placeholder.com/150'}" class="img-fluid rounded-circle" alt="Photo of ${doctor.name}" style="max-width: 200px; height: 200px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <h5> Dr. ${doctor.name} </h5>
                            <p><strong>Spesialisasi:</strong> ${doctor.speciality}</p>
                            <p><strong>Jadwal Praktek:</strong></p>
                            <table class="table table-bordered">
                                <thead style="background-color: #D3D3D3;">
                                    <tr>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${generateScheduleTable(doctor.schedules)}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;
            detailsDiv.appendChild(div);
        });
    }

    function generateScheduleTable(schedule) {
        if (!schedule || schedule.length === 0) {
            return '<tr><td colspan="2">Tidak ada jadwal praktek.</td></tr>';
        }
        return schedule.map(item => `
            <tr>
                <td>${item.day}</td>
                <td>${item.time}</td>
            </tr>
        `).join('');
    }
        // Fungsi untuk mengambil data dokter berdasarkan ID yang dipilih
        function fetchDoctorDetails() {
            const dokterSelect = document.getElementById('dokterSelect');
            const doctorId = dokterSelect.value;

            if (doctorId) {
                // Mengirim AJAX request ke server untuk mengambil data dokter
                fetch(`/dokter/${doctorId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Tampilkan informasi dokter di bawah daftar dokter
                        displayDoctorDetails(data);
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        // Fungsi untuk mengambil data klinik berdasarkan ID yang dipilih
        function fetchClinicDetails() {
            const klinikSelect = document.getElementById('klinikSelect');
            const clinicId = klinikSelect.value;

            if (clinicId) {
                // Mengirim AJAX request ke server untuk mengambil data klinik
                fetch(`/klinik/${clinicId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Tampilkan informasi klinik di bawah daftar klinik
                        displayClinicDetails(data);
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        // Fungsi untuk menampilkan detail dokter
        function displayDoctorDetails(doctor) {
            const detailsDiv = document.getElementById('detailsContainer');
            
            // Cek apakah elemen detail dokter sudah ada, jika ada kita hapus dulu
            detailsDiv.innerHTML = '';

            // Buat elemen baru untuk menampilkan detail dokter
            const div = document.createElement('div');
            div.classList.add('card');
            div.innerHTML = `
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <!-- Foto Dokter -->
                            <img src="${doctor.photo_path ? 'assets/img/' + doctor.photo_path : 'https://via.placeholder.com/150'}" class="img-fluid rounded-circle" alt="Photo of ${doctor.name}" style="max-width: 200px; height: 200px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <h5> Dr. ${doctor.name} </h5>
                            <p><strong>Spesialisasi:</strong> ${doctor.speciality}</p>
                            <p><strong>Jadwal Praktek:</strong></p>
                            <table class="table table-bordered">
                                <thead style="background-color: #D3D3D3;">
                                    <tr>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${generateScheduleTable(doctor.schedules)}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            `;
            
            // Menambahkan elemen detail dokter ke halaman
            detailsDiv.appendChild(div);
        }

        // Fungsi untuk menampilkan detail klinik
        function displayClinicDetails(clinic) {
            const detailsDiv = document.getElementById('detailsContainer');
            detailsDiv.innerHTML = '';

            const div = document.createElement('div');
            div.classList.add('card');
            div.innerHTML = `
                <div class="card-body">
                    <h5>${clinic.name}</h5>
                    <div class="mb-4">
                        ${clinic.doctors.map(doctor => `
                            <div class="card mb-3" style="border-radius: 10px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                             <img src="${doctor.photo_path ? 'assets/img/' + doctor.photo_path : 'https://via.placeholder.com/150'}" class="img-fluid rounded-circle" alt="Photo of ${doctor.name}" style="max-width: 200px; height: 200px; object-fit: cover;">
                                        </div>
                                        <div class="col-md-8">
                                            <h5>Dr. ${doctor.name}</h5>
                                            <p><strong>Spesialisasi:</strong> ${doctor.speciality}</p>
                                            <p><strong>Jadwal Praktek:</strong></p>
                                            <table class="table table-bordered">
                                                <thead style="background-color: #D3D3D3;">
                                                    <tr>
                                                        <th>Hari</th>
                                                        <th>Jam</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    ${generateScheduleTable(doctor.schedules)}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;
            detailsDiv.appendChild(div);
        }

        // Fungsi untuk generate schedule table
        function generateScheduleTable(schedule) {
            if (!schedule || schedule.length === 0) {
                return '<tr><td colspan="2">Tidak ada jadwal praktek.</td></tr>';
            }
            return schedule.map(item => `
                <tr>
                    <td>${item.day}</td>
                    <td>${item.time}</td>
                </tr>
            `).join('');
        }
    </script>
@endsection
