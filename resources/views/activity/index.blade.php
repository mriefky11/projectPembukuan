@php
    use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Kelola Kegiatan</h1>
        <a href="{{ route('activity.create') }}" class="btn btn-primary">Tambah Kegiatan</a>
    </div>

    <form method="GET" action="{{ route('activity.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama kegiatan"
            class="input input-bordered w-full max-w-xs" />
        <button class="btn btn-outline">Cari</button>
        @if (!empty($search))
            <a href="{{ route('activity.index') }}" class="btn btn-ghost">Reset</a>
        @endif
    </form>

    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="table w-full table-zebra">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($activity as $index => $act)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $act->name }}</td>
                        <td>{{ $act->deskripsi }}</td>
                        <td>{{ Carbon::parse($act->tanggal_mulai)->translatedFormat('d F Y') }}</td>
                        <td>{{ Carbon::parse($act->tanggal_selesai)->translatedFormat('d F Y') }}</td>
                        <td class="flex gap-2">
                            <a href="{{ route('activity.edit', $act->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <button class="btn btn-sm btn-info text-white"
                                onclick="showActivityDetail('{{ $act->id }}')">
                                Detail
                            </button>
                            <form action="{{ route('activity.destroy', $act->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-error">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500">Belum ada data kegiatan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <input type="checkbox" id="activityDetailModal" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box w-11/12 max-w-md">
            <h3 class="font-bold text-lg mb-4">Detail Kegiatan</h3>

            <div id="detail-content" class="space-y-2">
                <p><strong>Nama Kegiatan:</strong> <span id="detail-name"></span></p>
                <p><strong>Deskripsi:</strong> <span id="detail-deskripsi"></span></p>
                <p><strong>Tanggal Mulai:</strong> <span id="detail-start"></span></p>
                <p><strong>Tanggal Selesai:</strong> <span id="detail-end"></span></p>
            </div>

            <div class="modal-action">
                <label for="activityDetailModal" class="btn">Tutup</label>
            </div>
        </div>
    </div>

    <div class="flex justify-between items-center mt-4">
        <p class="text-sm text-gray-600">
            Menampilkan {{ $activity->count() }} dari {{ $activity->total() }} data
        </p>
        {{ $activity->links('pagination.tailwind') }}
    </div>

    <script>
        function showActivityDetail(id) {
            fetch(`/dashboard/activity/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detail-name').innerText = data.name;
                    document.getElementById('detail-deskripsi').innerText = data.deskripsi ?? '-';
                    document.getElementById('detail-start').innerText = data.tanggal_mulai;
                    document.getElementById('detail-end').innerText = data.tanggal_selesai;
                    document.getElementById('activityDetailModal').checked = true;
                })
                .catch(error => console.error(error));
        }
    </script>
@endsection
