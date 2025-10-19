@extends('layouts.app')

@section('content')
    <div class="mx-auto">
        <h1 class="text-xl font-bold mb-6">Tambah Kegiatan</h1>

        <form method="POST" action="{{ route('activity.store') }}" class="space-y-4">
            @csrf

            <div class="form-control">
                <label class="label font-semibold">Nama Kegiatan</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="input input-bordered @error('name') input-error @enderror" placeholder="Masukkan nama kegiatan"
                    required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-control">
                <label class="label font-semibold">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                    class="textarea textarea-bordered @error('deskripsi') textarea-error @enderror"
                    placeholder="Tuliskan deskripsi kegiatan">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-control">
                <label class="label font-semibold">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                    class="input input-bordered @error('tanggal_mulai') input-error @enderror" required>
                @error('tanggal_mulai')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-control">
                <label class="label font-semibold">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                    class="input input-bordered @error('tanggal_selesai') input-error @enderror" required>
                @error('tanggal_selesai')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('activity.index') }}" class="btn btn-ghost">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
