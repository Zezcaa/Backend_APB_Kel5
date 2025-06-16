@extends('layouts.app')

@section('content')
<div class="receipt-container">
    <div class="receipt-box shadow">
        <div class="header text-center">
            <img src="{{ asset('assets/img/LOGOKU.jpg') }}" alt="Logo" height="60">
            <h2 class="mt-2">HealthyCare Hospital</h2>
            <p>Jl. Kesehatan No.123, Jakarta, Indonesia<br>
            Telp: (021) 12345678 | Email: info@healthycare.com</p>
            <hr>
        </div>

        <div class="details">
            <div class="row">
                <div>
                    <strong>Nama Pasien:</strong> {{ $reservation->patient->name }}<br>
                    <strong>Metode Pembayaran:</strong> {{ ucfirst($reservation->payment_method) }}
                    @if($reservation->insurance_number)
                        <br><strong>No. Asuransi:</strong> {{ $reservation->insurance_number }}
                    @endif
                </div>
                <div class="text-right">
                    <strong>Kamar:</strong> {{ $reservation->room->type }}<br>
                    <strong>Tanggal Reservasi:</strong> {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d-m-Y') }}
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th class="text-right">Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Reservasi Kamar {{ $reservation->room->type }}</td>
                    <td class="text-right">Rp {{ number_format($reservation->room->price, 0, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total</th>
                    <th class="text-right">Rp {{ number_format($reservation->room->price, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>

        <div class="footer text-center mt-4">
            <p><em>Terima kasih telah mempercayakan layanan kami. Semoga lekas sembuh.</em></p>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('index') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
        </div>
    </div>
</div>
@endsection

<style>
.receipt-container {
    max-width: 750px;
    margin: auto;
    padding: 40px 20px;
}

.receipt-box {
    background: #fff;
    padding: 30px 40px;
    border-radius: 12px;
    border: 1px solid #ddd;
    font-size: 1rem;
}

.header h2 {
    margin: 0;
    font-weight: 700;
    color:#007bff;
}

.header p {
    margin-bottom: 10px;
    color: #555;
}

.table {
    width: 100%;
    margin-top: 30px;
    border-collapse: collapse;
}

.table th, .table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

.table tfoot th {
    border-top: 2px solid #28a745;
    font-size: 1.1rem;
}

.row {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.btn-primary {
    padding: 10px 25px;
    border-radius: 50px;
    background-color: #007bff;
    font-weight: bold;
    font-size: 1rem;
    text-decoration: none;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.text-right {
    text-align: right;
}
</style>
