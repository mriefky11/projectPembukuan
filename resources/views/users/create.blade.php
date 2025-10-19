@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">Tambah Pengguna</h1>

    <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
        @csrf

        <div class="form-control">
            <label class="label">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="input input-bordered @error('name') input-error @enderror" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-control">
            <label class="label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                class="input input-bordered @error('email') input-error @enderror" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-control relative">
            <label class="label">Password</label>
            <input type="password" name="password" id="password"
                class="input input-bordered pr-10 @error('password') input-error @enderror" required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-control relative">
            <label class="label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="input input-bordered pr-10" required>
        </div>

        <div class="form-control">
            <label class="label">Role</label>
            <select name="role" class="select select-bordered @error('role') select-error @enderror" required>
                <option value="">-- Pilih Role --</option>
                <option value="bendahara" {{ old('role') == 'bendahara' ? 'selected' : '' }}>Bendahara</option>
                <option value="kepala_sekolah" {{ old('role') == 'kepala_sekolah' ? 'selected' : '' }}>Kepala Sekolah
                </option>
                <option value="yayasan" {{ old('role') == 'yayasan' ? 'selected' : '' }}>Yayasan</option>
                <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator</option>
            </select>
            @error('role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
@endsection
