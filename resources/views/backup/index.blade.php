@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">Backup Data Sistem</h2>

        <p>
            <strong>Tanggal Backup Terakhir:</strong>
            {{ $lastBackup ? \Carbon\Carbon::parse($lastBackup)->format('d M Y H:i') : 'Belum pernah melakukan backup' }}
        </p>


        <form action="{{ route('backup.run') }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Mulai Backup Sekarang
            </button>
        </form>

        @if (session('success'))
            <div class="mt-4 bg-green-100 text-green-800 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mt-4 bg-red-100 text-red-800 p-3 rounded">
                {{ session('error') }}
            </div>
        @endif
    </div>
@endsection
