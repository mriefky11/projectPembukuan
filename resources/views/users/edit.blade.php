@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">Edit Pengguna</h1>

    <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="form-control">
            <label class="label">Nama</label>
            <input type="text" name="name" value="{{ $user->name }}"
                class="input input-bordered @error('name') input-error @enderror" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-control">
            <label class="label">Email</label>
            <input type="email" name="email" value="{{ $user->email }}"
                class="input input-bordered @error('email') input-error @enderror" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-control">
            <label class="label">Password (opsional)</label>
            <input type="password" name="password" class="input input-bordered @error('password') input-error @enderror"
                placeholder="Kosongkan jika tidak ingin mengubah password">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-control">
            <label class="label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="input input-bordered @error('password_confirmation') input-error @enderror"
                placeholder="Ulangi password baru">
            @error('password_confirmation')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-control">
            <label class="label">Role</label>
            <select name="role" class="select select-bordered @error('role') select-error @enderror" required>
                <option value="bendahara" {{ $user->role == 'bendahara' ? 'selected' : '' }}>Bendahara</option>
                <option value="kepala_sekolah" {{ $user->role == 'kepala_sekolah' ? 'selected' : '' }}>Kepala Sekolah
                </option>
                <option value="yayasan" {{ $user->role == 'yayasan' ? 'selected' : '' }}>Yayasan</option>
                <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>Operator</option>
            </select>
            @error('role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
@endsection
