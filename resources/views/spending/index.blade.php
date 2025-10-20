@php
    use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Data Pengeluaran</h1>
        <a href="{{ route('spending.create') }}" class="btn btn-primary">Tambah Pengeluaran</a>
    </div>

    <form method="GET" action="{{ route('spending.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari kegiatan atau pembuat..."
            class="input input-bordered w-full max-w-xs" />
        <button class="btn btn-outline">Cari</button>
        @if (!empty($search))
            <a href="{{ route('spending.index') }}" class="btn btn-ghost">Reset</a>
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
                    <th>Kategori Biaya</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Dibuat oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($spending as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->activity->name ?? '-' }}</td>
                        <td>{{ $item->category->nama_kategori ?? '-' }}</td>
                        <td>{{ Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                        <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td>{{ $item->user->name ?? '-' }}</td>
                        <td class="flex gap-2">
                            <button class="btn btn-sm btn-info text-white"
                                onclick="showSpendingDetail('{{ $item->id }}')">
                                Detail
                            </button>
                            <a href="{{ route('spending.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('spending.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus data ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-error">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-gray-500">Belum ada data pengeluaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-between items-center mt-4">
        <p class="text-sm text-gray-600">
            Menampilkan {{ $spending->count() }} dari {{ $spending->total() }} data
        </p>
        {{ $spending->links('pagination.tailwind') }}
    </div>

    <input type="checkbox" id="spendingDetailModal" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box w-11/12 max-w-md">
            <h3 class="font-bold text-lg mb-4">Detail Pengeluaran</h3>

            <div id="detail-content">
                <p><strong>Kegiatan:</strong> <span id="detail-kegiatan"></span></p>
                <p><strong>Kategori Biaya:</strong> <span id="detail-kategori"></span></p>
                <p><strong>Tanggal:</strong> <span id="detail-tanggal"></span></p>
                <p><strong>Jumlah:</strong> <span id="detail-jumlah"></span></p>
                <p><strong>Keterangan:</strong> <span id="detail-keterangan"></span></p>
                <p><strong>Dibuat oleh:</strong> <span id="detail-user"></span></p>
            </div>

            <div class="modal-action">
                <label for="spendingDetailModal" class="btn">Tutup</label>
            </div>
        </div>
    </div>

    <script>
        function showSpendingDetail(id) {
            fetch(`/dashboard/spending/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detail-kegiatan').innerText = data.activity?.name ?? '-';
                    document.getElementById('detail-kategori').innerText = data.category?.nama_kategori ?? '-';
                    document.getElementById('detail-tanggal').innerText = data.tanggal ?? '-';
                    document.getElementById('detail-jumlah').innerText =
                        `Rp${Number(data.jumlah).toLocaleString('id-ID')}`;
                    document.getElementById('detail-keterangan').innerText = data.keterangan ?? '-';
                    document.getElementById('detail-user').innerText = data.user?.name ?? '-';
                    document.getElementById('spendingDetailModal').checked = true;
                })
                .catch(error => console.error(error));
        }
    </script>
@endsection
