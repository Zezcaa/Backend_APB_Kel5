@extends('layouts.admin')

@section('content')
<div class="container my-4">

    <input type="text" id="searchPatient" placeholder="Cari nama pasien..." class="form-control mb-4" style="max-width: 400px;">

    <div id="result">
        {{-- Tampilkan data awal pasien dari backend --}}
        @foreach ($patients as $patient)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Nama: {{ $patient->name }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Usia:</strong> {{ $patient->age ?? 'Data tidak tersedia' }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $patient->birth_date ?? 'Data tidak tersedia' }}</p>
                <p><strong>No. Rekam Medis:</strong> {{ $patient->medical_record_number ?? 'Data tidak tersedia' }}</p>

                <h5 class="mt-4">Hasil Periksa:</h5>
                @if ($patient->hasilPeriksa)
                <table class="table table-bordered mb-4">
                    <thead class="table-light">
                        <tr>
                            <th>Diagnosa</th>
                            <th>Jenis Rawat</th>
                            <th>Resep</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $patient->hasilPeriksa->diagnosa }}</td>
                            <td>{{ $patient->hasilPeriksa->jenis_rawat }}</td>
                            <td>{{ $patient->hasilPeriksa->resep }}</td>
                        </tr>
                    </tbody>
                </table>
                @else
                <p><em>Belum ada hasil periksa.</em></p>
                @endif

                <h5 class="mt-4">Daftar Reservasi:</h5>
                @if ($patient->reservations->count() > 0)
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Tipe Kamar</th>
                            <th>Tanggal Reservasi</th>
                            <th>Metode Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patient->reservations as $res)
                        <tr>
                            <td>{{ $res->room->type ?? 'Tipe kamar tidak diketahui' }}</td>
                            <td>{{ $res->reservation_date }}</td>
                            <td>{{ ucfirst($res->payment_method) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p><em>Pasien ini belum memiliki reservasi.</em></p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    const searchInput = document.getElementById('searchPatient');
    const resultDiv = document.getElementById('result');

    searchInput.addEventListener('input', function() {
        const query = this.value.trim();

        if(query.length === 0){
            // Jika input kosong, reload halaman (tampilkan data awal)
            window.location.reload();
            return;
        }

        fetch(`/admin/search-pasien?name=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                if(!data.patients || data.patients.length === 0){
                    resultDiv.innerHTML = '<p>Pasien tidak ditemukan.</p>';
                    return;
                }

                let html = '';
                data.patients.forEach(patient => {
                    html += `
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">Nama: ${patient.name}</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Usia:</strong> ${patient.age ?? 'Data tidak tersedia'}</p>
                            <p><strong>Tanggal Lahir:</strong> ${patient.birth_date ?? 'Data tidak tersedia'}</p>
                            <p><strong>No. Rekam Medis:</strong> ${patient.medical_record_number ?? 'Data tidak tersedia'}</p>

                            <h5 class="mt-4">Hasil Periksa:</h5>
                            ${
                                patient.hasilPeriksa
                                ? `<table class="table table-bordered mb-4">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Diagnosa</th>
                                            <th>Jenis Rawat</th>
                                            <th>Resep</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>${patient.hasilPeriksa.diagnosa}</td>
                                            <td>${patient.hasilPeriksa.jenis_rawat}</td>
                                            <td>${patient.hasilPeriksa.resep}</td>
                                        </tr>
                                    </tbody>
                                </table>`
                                : '<p><em>Belum ada hasil periksa.</em></p>'
                            }

                            <h5 class="mt-4">Daftar Reservasi:</h5>
                            ${
                                patient.reservations && patient.reservations.length > 0
                                ? `<table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tipe Kamar</th>
                                            <th>Tanggal Reservasi</th>
                                            <th>Metode Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${patient.reservations.map(res => `
                                            <tr>
                                                <td>${res.room_type ?? 'Tipe kamar tidak diketahui'}</td>
                                                <td>${res.reservation_date}</td>
                                                <td>${res.payment_method.charAt(0).toUpperCase() + res.payment_method.slice(1)}</td>
                                            </tr>
                                        `).join('')}
                                    </tbody>
                                </table>`
                                : '<p><em>Pasien ini belum memiliki reservasi.</em></p>'
                            }
                        </div>
                    </div>
                    `;
                });

                resultDiv.innerHTML = html;
            })
            .catch(err => {
                resultDiv.innerHTML = '<p>Terjadi kesalahan saat mencari pasien.</p>';
                console.error(err);
            });
    });
</script>
@endsection
