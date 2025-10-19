@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">Edit Kegiatan</h1>

    <form method="POST" action="{{ route('activity.update', $activity->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="form-control">
            <label class="label">Nama Kegiatan</label>
            <input type="text" name="name" value="{{ old('name', $activity->name) }}"
                class="input input-bordered @error('name') input-error @enderror" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-control">
            <label class="label">Deskripsi</label>
            <textarea name="deskripsi" class="textarea textarea-bordered @error('deskripsi') textarea-error @enderror"
                rows="3">{{ old('deskripsi', $activity->deskripsi) }}</textarea>
            @error('deskripsi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-control">
            <label class="label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $activity->tanggal_mulai) }}"
                class="input input-bordered @error('tanggal_mulai') input-error @enderror" required>
            @error('tanggal_mulai')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-control">
            <label class="label">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $activity->tanggal_selesai) }}"
                class="input input-bordered @error('tanggal_selesai') input-error @enderror" required>
            @error('tanggal_selesai')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('activity.index') }}" class="btn btn-ghost">Batal</a>
        </div>
    </form>
@endsection
