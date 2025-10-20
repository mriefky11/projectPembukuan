@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-bold mb-4">Tambah Pengeluaran</h2>

        <form action="{{ route('spending.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="block font-semibold mb-1">Kegiatan</label>
                <select name="kegiatan_id" class="select select-bordered w-full @error('kegiatan_id') select-error @enderror"
                    required>
                    <option value="">-- Pilih Kegiatan --</option>
                    @foreach ($activities as $activity)
                        <option value="{{ $activity->id }}" {{ old('kegiatan_id') == $activity->id ? 'selected' : '' }}>
                            {{ $activity->name }}
                        </option>
                    @endforeach
                </select>
                @error('kegiatan_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Kategori Biaya</label>
                <select name="kategori_id"
                    class="select select-bordered w-full @error('kategori_id') select-error @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Tanggal</label>
                <input type="date" name="tanggal"
                    class="input input-bordered w-full @error('tanggal') input-error @enderror" value="{{ old('tanggal') }}"
                    required>
                @error('tanggal')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Jumlah (Rp)</label>
                <input type="number" name="jumlah"
                    class="input input-bordered w-full @error('jumlah') input-error @enderror" value="{{ old('jumlah') }}"
                    required>
                @error('jumlah')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="block font-semibold mb-1">Keterangan</label>
                <textarea name="keterangan" class="textarea textarea-bordered w-full @error('keterangan') textarea-error @enderror"
                    rows="2">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('spending.index') }}" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
