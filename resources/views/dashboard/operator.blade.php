@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard Operator</h1>

    <div class="stats shadow bg-base-100">
        <div class="stat">
            <div class="stat-title">Jumlah Pengguna</div>
            <div class="stat-value">{{ $jumlahPengguna }}</div>
        </div>
        <div class="stat">
            <div class="stat-title">Tanggal Hari Ini</div>
            <div class="stat-value">{{ $tanggalHariIni }}</div>
        </div>
        <div class="stat">
            <div class="stat-title">Tanggal Backup Terakhir</div>
            <div class="stat-value">{{ $lastBackup ? $lastBackup : 'Belum pernah melakukan backup' }}</div>
        </div>
    </div>

    <p class="mt-6 text-gray-500">
        Selamat datang, {{ $user->name }} — Anda login sebagai
        <strong>{{ ucfirst(str_replace('_', ' ', $user->role)) }}</strong>.
    </p>
@endsection
