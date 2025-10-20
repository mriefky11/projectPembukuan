@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-bold mb-4">Tambah Pemasukan</h2>

        <form action="{{ route('income.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="block font-semibold mb-1">Kegiatan</label>
                <select name="kegiatan_id" class="select select-bordered w-full" required>
                    <option value="">-- Pilih Kegiatan --</option>
                    @foreach ($activities as $activity)
                        <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Tanggal</label>
                <input type="date" name="tanggal" class="input input-bordered w-full" required>
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Jumlah (Rp)</label>
                <input type="number" name="jumlah" class="input input-bordered w-full" required>
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Keterangan</label>
                <textarea name="keterangan" class="textarea textarea-bordered w-full" rows="2"></textarea>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('income.index') }}" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
