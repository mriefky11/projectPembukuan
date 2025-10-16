@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard Utama</h1>

    <div class="stats shadow bg-base-100">
        <div class="stat">
            <div class="stat-title">Total Pemasukan</div>
            <div class="stat-value text-success">Rp 25.000.000</div>
        </div>
        <div class="stat">
            <div class="stat-title">Total Pengeluaran</div>
            <div class="stat-value text-error">Rp 18.000.000</div>
        </div>
    </div>

    <p class="mt-6 text-gray-500">
        Selamat datang, {{ auth()->user()->name }} — Anda login sebagai
        <strong>{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</strong>.
    </p>
@endsection
