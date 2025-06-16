<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2 class="text-center mb-4">Jadwal Dokter</h2>

    <a href="{{ route('dokter.create') }}" class="btn btn-success mb-3">Tambah Jadwal</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
        <tr>
            <th>Nama Dokter</th>
            <th>Poliklinik</th>
            <th>Hari</th>
            <th>Waktu</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($doctors as $doctor)
            @foreach($doctor->schedules as $schedule)
                <tr>
                    <td>{{ $doctor->nama_dokter }}</td>
                    <td>{{ $doctor->clinic->nama_klinik ?? '-' }}</td>
                    <td>{{ $schedule->day }}</td>
                    <td>{{ $schedule->time }}</td>
                    <td>
                        <a href="{{ route('dokter.edit', $schedule->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('dokter.destroy', $schedule->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
