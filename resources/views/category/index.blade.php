@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Kategori Biaya</h1>
        <label for="addKategoriModal" class="btn btn-primary cursor-pointer">Tambah Kategori</label>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <table class="table w-full table-zebra">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Jenis Biaya</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($category as $index => $kat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kat->nama_kategori }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $kat->jenis_biaya)) }}</td>
                    <td class="flex gap-2">
                        <form action="{{ route('category.destroy', $kat->id) }}" method="POST"
                            onsubmit="return confirm('Yakin hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-error">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500">Belum ada kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="flex justify-between items-center mt-4">
        <p class="text-sm text-gray-600">
            Menampilkan {{ $category->count() }} dari {{ $category->total() }} data
        </p>
        {{ $category->links('pagination.tailwind') }}
    </div>

    <input type="checkbox" id="addKategoriModal" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">Tambah Kategori Biaya</h3>
            <form action="{{ route('category.store') }}" method="POST" class="space-y-3">
                @csrf
                <div class="form-control">
                    <label class="label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="input input-bordered" required>
                    @error('nama_kategori')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-control">
                    <label class="label">Jenis Biaya</label>
                    <select name="jenis_biaya" class="select select-bordered" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="biaya_langsung">Biaya Langsung</option>
                        <option value="biaya_tidak_langsung">Biaya Tidak Langsung</option>
                    </select>
                    @error('jenis_biaya')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <label for="addKategoriModal" class="btn">Batal</label>
                </div>
            </form>
        </div>
    </div>
@endsection
