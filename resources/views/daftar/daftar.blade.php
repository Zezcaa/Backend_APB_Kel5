@extends('layouts.app')

@section('content')
    <script>
        window.location.href = "{{ route('patients.register') }}";
    </script>
@endsection
