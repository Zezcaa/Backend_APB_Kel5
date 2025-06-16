@extends('layouts.app')

@section('content')
<style>
.container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
}

.title {
    font-size: 32px;
    font-weight: bold;
    color: #2c3e50;
    text-align: center;
    margin-bottom: 10px;
}

.subtitle {
    font-size: 18px;
    color: #7f8c8d;
    text-align: center;
    margin-bottom: 40px;
}

.rooms-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
}

.room-card {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: 0.3s;
}

.room-card:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
}

.room-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.room-content {
    padding: 20px;
}

.room-type {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #34495e;
}

.room-description {
    font-size: 14px;
    color: #7f8c8d;
    margin-bottom: 20px;
}

.btn-reserve {
    display: block;
    text-align: center;
    background-color: #3399ff;
    color: white;
    padding: 10px 0;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: background 0.3s;
}

.btn-reserve:hover {
    background-color: #007bff;
}
</style>

<div class="container">
    <h1 class="title">Tipe Kamar Rawat Inap</h1>
    <p class="subtitle">Pilih tipe kamar yang sesuai dengan kebutuhan Anda.</p>

    <div class="rooms-grid">
        @foreach($rooms as $room)
            <div class="room-card">
                <img src="{{ asset('assets/img/'.$room->photo_path) }}" alt="{{ $room->type }}" class="room-image">
                <div class="room-content">
                    <h2 class="room-type">{{ $room->type }}</h2>
                    <p class="room-description">{{ $room->description }}</p>
                    <a href="{{ route('reservasi.create', ['roomId' => $room->id]) }}" class="btn-reserve">Pesan Kamar</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
