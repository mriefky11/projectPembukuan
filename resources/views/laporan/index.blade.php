@extends('layouts.app')

@section('content')
    <div class="p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">Laporan Keuangan</h2>

        {{-- Form Generate --}}
        @if (auth()->user()->role === 'bendahara')
            <form action="{{ route('laporan.generate') }}" method="POST" class="mb-4 flex gap-2 flex-wrap">
                @csrf
                <select name="kegiatan_id" class="select select-bordered">
                    <option value="">-- Pilih Kegiatan --</option>
                    @foreach ($activities as $activity)
                        <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                    @endforeach
                </select>
                <input type="month" name="periode" class="input input-bordered">
                <button type="submit" class="btn btn-primary">Generate</button>
            </form>
        @endif

        <div class="flex gap-2 mb-4 items-center flex-wrap">
            <form action="{{ route('laporan.index') }}" method="GET" class="flex gap-2 items-center">
                <input type="text" name="search" placeholder="Cari kegiatan atau periode..."
                    class="input input-bordered" value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary">Cari</button>
            </form>

            <a href="{{ route('laporan.download', 'xlsx') }}" class="btn btn-success">Download Excel</a>
            <a href="{{ route('laporan.download', 'pdf') }}" class="btn btn-secondary">Download PDF</a>
        </div>


        @if (session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kegiatan</th>
                        <th>Periode</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran Langsung</th>
                        <th>Pengeluaran Tidak Langsung</th>
                        <th>Total Pengeluaran</th>
                        <th>Saldo</th>
                        @if (auth()->user()->role === 'bendahara')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $item)
                        <tr>
                            <td>{{ $loop->iteration + ($laporan->currentPage() - 1) * $laporan->perPage() }}</td>
                            <td>{{ $item->kegiatan->name }}</td>
                            <td>{{ $item->periode }}</td>
                            <td>Rp. {{ number_format($item->total_pemasukan, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($item->total_pengeluaran_langsung, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($item->total_pengeluaran_tidak_langsung, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($item->total_pengeluaran, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($item->saldo, 0, ',', '.') }}</td>
                            @if (auth()->user()->role === 'bendahara')
                                <td>
                                    <form action="{{ route('laporan.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-error btn-sm">Hapus</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Data laporan belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="flex justify-between items-center mt-4 flex-wrap">
            <p class="text-sm text-gray-600">
                Menampilkan {{ $laporan->count() }} dari {{ $laporan->total() }} data
            </p>
            {{ $laporan->links('pagination.tailwind') }}
        </div>
    </div>
@endsection
