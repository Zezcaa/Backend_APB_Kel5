@extends('layouts.admin') {{-- Atur sesuai layout kamu --}}

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Kritik dan Saran</h2>

    @if($kritikList->isEmpty())
        <p>Belum ada kritik atau saran.</p>
    @else
        <ul class="list-group">
            @foreach ($kritikList as $kritik)
                <li class="list-group-item">
                    <p>{{ $kritik->pesan }}</p>
                    <small class="text-muted">{{ $kritik->created_at->format('d M Y H:i') }}</small>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
