@php
    use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Data Pemasukan</h1>
        <a href="{{ route('income.create') }}" class="btn btn-primary">Tambah Pemasukan</a>
    </div>

    {{-- Form Search --}}
    <form method="GET" action="{{ route('income.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari kegiatan atau pembuat..."
            class="input input-bordered w-full max-w-xs" />
        <button class="btn btn-outline">Cari</button>
        @if (!empty($search))
            <a href="{{ route('income.index') }}" class="btn btn-ghost">Reset</a>
        @endif
    </form>

    {{-- Alert sukses --}}
    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="table w-full table-zebra">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Dibuat oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($incomes as $index => $income)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $income->activity->name ?? '-' }}</td>
                        <td>{{ Carbon::parse($income->tanggal)->translatedFormat('d F Y') }}</td>
                        <td>Rp {{ number_format($income->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $income->keterangan ?? '-' }}</td>
                        <td>{{ $income->user->name ?? '-' }}</td>
                        <td class="flex gap-2">
                            <button class="btn btn-sm btn-info text-white"
                                onclick="showIncomeDetail('{{ $income->id }}')">
                                Detail
                            </button>
                            <a href="{{ route('income.edit', $income->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('income.destroy', $income->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus data ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-error">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500">Belum ada data pemasukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-between items-center mt-4">
        <p class="text-sm text-gray-600">
            Menampilkan {{ $incomes->count() }} dari {{ $incomes->total() }} data
        </p>
        {{ $incomes->links('pagination.tailwind') }}
    </div>

    {{-- Modal Detail --}}
    <input type="checkbox" id="incomeDetailModal" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box w-11/12 max-w-md">
            <h3 class="font-bold text-lg mb-4">Detail Pemasukan</h3>

            <div id="detail-content">
                <p><strong>Kegiatan:</strong> <span id="detail-kegiatan"></span></p>
                <p><strong>Tanggal:</strong> <span id="detail-tanggal"></span></p>
                <p><strong>Jumlah:</strong> <span id="detail-jumlah"></span></p>
                <p><strong>Keterangan:</strong> <span id="detail-keterangan"></span></p>
                <p><strong>Dibuat oleh:</strong> <span id="detail-user"></span></p>
            </div>

            <div class="modal-action">
                <label for="incomeDetailModal" class="btn">Tutup</label>
            </div>
        </div>
    </div>

    <script>
        function showIncomeDetail(id) {
            fetch(`/dashboard/income/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detail-kegiatan').innerText = data.activity?.name ?? '-';
                    document.getElementById('detail-tanggal').innerText = data.tanggal ?? '-';
                    document.getElementById('detail-jumlah').innerText =
                        `Rp${Number(data.jumlah).toLocaleString('id-ID')}`;
                    document.getElementById('detail-keterangan').innerText = data.keterangan ?? '-';
                    document.getElementById('detail-user').innerText = data.user?.name ?? '-';

                    document.getElementById('incomeDetailModal').checked = true;
                })
                .catch(error => console.error(error));
        }
    </script>
@endsection
