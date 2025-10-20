@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-bold mb-4">Edit Pemasukan</h2>

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-error mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('income.update', $income->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Kegiatan --}}
            <div class="mb-3">
                <label class="block font-semibold mb-1">Kegiatan</label>
                <select name="kegiatan_id" class="select select-bordered w-full @error('kegiatan_id') select-error @enderror"
                    required>
                    @foreach ($activities as $activity)
                        <option value="{{ $activity->id }}"
                            {{ old('kegiatan_id', $income->kegiatan_id) == $activity->id ? 'selected' : '' }}>
                            {{ $activity->name }}
                        </option>
                    @endforeach
                </select>
                @error('kegiatan_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal --}}
            <div class="mb-3">
                <label class="block font-semibold mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $income->tanggal) }}"
                    class="input input-bordered w-full @error('tanggal') input-error @enderror" required>
                @error('tanggal')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jumlah --}}
            <div class="mb-3">
                <label class="block font-semibold mb-1">Jumlah (Rp)</label>
                <input type="number" name="jumlah" value="{{ old('jumlah', $income->jumlah) }}"
                    class="input input-bordered w-full @error('jumlah') input-error @enderror" required>
                @error('jumlah')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div class="mb-3">
                <label class="block font-semibold mb-1">Keterangan</label>
                <textarea name="keterangan" class="textarea textarea-bordered w-full @error('keterangan') textarea-error @enderror"
                    rows="2">{{ old('keterangan', $income->keterangan) }}</textarea>
                @error('keterangan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-2">
                <a href="{{ route('income.index') }}" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
@endsection
