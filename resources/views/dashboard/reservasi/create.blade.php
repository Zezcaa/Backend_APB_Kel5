@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Pemesanan Kamar Rumah Sakit</h1>

    <div class="card mb-4 shadow-sm">
        <div class="card-header text-center">
            <h4 class="mb-0">Kamar: {{ $room->name }}</h4>
        </div>
        <div class="card-body text-center">
            <p><strong>Tipe Kamar:</strong> {{ $room->type }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($room->price, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('reservasi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">

                <div class="row g-3">
                    <div class="col-12">
                        <label for="patient_name" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control" id="patient_name" name="patient_name" required placeholder="Masukkan nama pasien" autocomplete="off">
                        <ul id="patient-list" class="list-group position-relative" style="z-index: 1000;"></ul>
                    </div>

                    <div class="col-md-6">
                        <label for="patient_age" class="form-label">Umur</label>
                        <input type="number" class="form-control" id="patient_age" name="patient_age" placeholder="Masukkan umur" min="0">
                    </div>

                    <div class="col-md-6">
                        <label for="patient_gender" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="patient_gender" name="patient_gender">
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="patient_birth_date" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="patient_birth_date" name="patient_birth_date">
                    </div>

                    <div class="col-md-6">
                        <label for="reservation_date" class="form-label">Tanggal Reservasi</label>
                        <input type="date" class="form-control" id="reservation_date" name="reservation_date" required>
                    </div>

                    <div class="col-12">
                        <label for="payment_method" class="form-label">Metode Pembayaran</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                            <option value="mandiri">Mandiri</option>
                            <option value="bpjs">BPJS</option>
                            <option value="asuransi">Asuransi Lain</option>
                        </select>
                    </div>

                    <div class="col-12" id="insurance_details" style="display: none;">
                        <label for="insurance_number" class="form-label">Nomor Asuransi</label>
                        <input type="text" class="form-control" id="insurance_number" name="insurance_number" placeholder="Masukkan nomor asuransi">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-4">Pesan Kamar</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethodSelect = document.getElementById('payment_method');
        const insuranceDetails = document.getElementById('insurance_details');

        paymentMethodSelect.addEventListener('change', function() {
            if (this.value === 'asuransi') {
                insuranceDetails.style.display = 'block';
            } else {
                insuranceDetails.style.display = 'none';
            }
        });

        $('#patient_name').on('input', function() {
            let name = $(this).val();

            if (name.length >= 2) {
                $.ajax({
                    url: '/search-patient',
                    type: 'GET',
                    data: { name: name },
                    success: function(response) {
                        let list = $('#patient-list');
                        list.empty();
                        if (response.length > 0) {
                            response.forEach(patient => {
                                list.append(`<li class="list-group-item list-group-item-action patient-item" data-id="${patient.id}" style="cursor:pointer;">${patient.name}</li>`);
                            });
                        } else {
                            list.append('<li class="list-group-item">No patients found</li>');
                        }
                    }
                });
            } else {
                $('#patient-list').empty();
            }
        });

        $(document).on('click', '.patient-item', function() {
            let patientName = $(this).text();
            let patientId = $(this).data('id');

            $('#patient_name').val(patientName);
            $('#patient-list').empty();

            if (!$('#patient_id').length) {
                $('<input>').attr({
                    type: 'hidden',
                    id: 'patient_id',
                    name: 'patient_id',
                    value: patientId
                }).appendTo('form');
            } else {
                $('#patient_id').val(patientId);
            }
        });
    });
</script>

@endsection

@section('styles')
<style>
    body {
        background-color: #f7f7f7;
    }

    .card {
        border-radius: 10px;
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        font-size: 1.25rem;
        font-weight: 600;
        text-align: center;
    }

    .form-label {
        font-weight: 600;
    }

    .form-select, .form-control {
        border-radius: 8px;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 10px;
        font-size: 1.1rem;
        padding: 12px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    /* Styling list pencarian pasien */
    #patient-list {
        position: absolute;
        width: 100%;
        max-height: 180px;
        overflow-y: auto;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 0 0 10px 10px;
        z-index: 1050;
        margin-top: 0;
        padding-left: 0;
        list-style: none;
    }

    #patient-list li {
        padding: 10px 15px;
        cursor: pointer;
    }

    #patient-list li:hover {
        background-color: #f0f0f0;
    }

    /* Responsive tweaks */
    @media (max-width: 576px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .card-body form .row > div {
            margin-bottom: 1rem;
        }
    }
</style>
@endsection
