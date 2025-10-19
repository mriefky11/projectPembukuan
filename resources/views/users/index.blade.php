@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Kelola Pengguna</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Pengguna</a>
    </div>

    <form method="GET" action="{{ route('users.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama, email, atau role..."
            class="input input-bordered w-full max-w-xs" />
        <button class="btn btn-outline">Cari</button>
        @if (!empty($search))
            <a href="{{ route('users.index') }}" class="btn btn-ghost">Reset</a>
        @endif
    </form>

    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="table w-full table-zebra">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucwords(str_replace('_', ' ', $user->role)) }}</td>
                        <td class="flex gap-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <button class="btn btn-sm btn-info text-white" onclick="showUserDetail({{ $user->id }})">
                                Detail
                            </button>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-error">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500">Belum ada data pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <input type="checkbox" id="userDetailModal" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box w-11/12 max-w-md">
            <h3 class="font-bold text-lg mb-4">Detail User</h3>

            <div id="detail-content">
                <p><strong>Nama:</strong> <span id="detail-name"></span></p>
                <p><strong>Email:</strong> <span id="detail-email"></span></p>
                <p><strong>Role:</strong> <span id="detail-role"></span></p>
            </div>

            <div class="modal-action">
                <label for="userDetailModal" class="btn">Tutup</label>
            </div>
        </div>
    </div>


    <div class="flex justify-between items-center mt-4">
        <p class="text-sm text-gray-600">
            Menampilkan {{ $users->count() }} dari {{ $users->total() }} data
        </p>
        {{ $users->links('pagination.tailwind') }}
    </div>

    <script>
        function showUserDetail(id) {
            fetch(`/dashboard/users/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detail-name').innerText = data.name;
                    document.getElementById('detail-email').innerText = data.email;
                    document.getElementById('detail-role').innerText = data.role;

                    document.getElementById('userDetailModal').checked = true;
                })
                .catch(error => console.error(error));
        }
    </script>
@endsection
