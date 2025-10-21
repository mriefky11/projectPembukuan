@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard Utama</h1>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <div class="stat shadow bg-base-100">
            <div class="stat-title">Total Saldo Saat Ini</div>
            <div class="stat-value text-primary">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</div>
        </div>

        <div class="stat shadow bg-base-100">
            <div class="stat-title">Total Pemasukan</div>
            <div class="stat-value text-success">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
        </div>

        <div class="stat shadow bg-base-100">
            <div class="stat-title">Total Pengeluaran</div>
            <div class="stat-value text-error">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
        </div>

        <div class="stat shadow bg-base-100">
            <div class="stat-title">Biaya Langsung</div>
            <div class="stat-value">Rp {{ number_format($totalBiayaLangsung, 0, ',', '.') }}</div>
        </div>

        <div class="stat shadow bg-base-100">
            <div class="stat-title">Biaya Tidak Langsung</div>
            <div class="stat-value">Rp {{ number_format($totalBiayaTidakLangsung, 0, ',', '.') }}</div>
        </div>

        <div class="stat shadow bg-base-100">
            <div class="stat-title">Total Kegiatan</div>
            <div class="stat-value">{{ $totalKegiatan }}</div>
        </div>
    </div>

    <p class="mt-2 text-gray-500">
        Selamat datang, {{ $user->name }} — Anda login sebagai
        <strong>{{ ucfirst(str_replace('_', ' ', $user->role)) }}</strong>.
    </p>
@endsection
