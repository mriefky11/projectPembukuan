<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriBiayaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori_biaya')->insert([
            [
                'id' => Str::uuid(),
                'nama_kategori' => 'SPP Bulanan',
                'jenis_biaya' => 'biaya_langsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_kategori' => 'Uang Pendaftaran',
                'jenis_biaya' => 'biaya_langsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_kategori' => 'Uang Gedung',
                'jenis_biaya' => 'biaya_langsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_kategori' => 'Seragam Sekolah',
                'jenis_biaya' => 'biaya_langsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_kategori' => 'Kegiatan Pramuka',
                'jenis_biaya' => 'biaya_langsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_kategori' => 'Kegiatan Pesantren Kilat',
                'jenis_biaya' => 'biaya_langsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_kategori' => 'Asrama Santri',
                'jenis_biaya' => 'biaya_langsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_kategori' => 'Kegiatan Tahunan Sekolah',
                'jenis_biaya' => 'biaya_langsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_kategori' => 'Kegiatan Study Tour',
                'jenis_biaya' => 'biaya_langsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_kategori' => 'Ujian Akhir Semester',
                'jenis_biaya' => 'biaya_langsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // biaya tidak langsung
            [
                'id' => Str::uuid(),
                'nama_kategori' => 'Listrik & Air',
                'jenis_biaya' => 'biaya_tidak_langsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_kategori' => 'Konsumsi Guru dan Pegawai',
                'jenis_biaya' => 'biaya_tidak_langsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_kategori' => 'Pemeliharaan Fasilitas Sekolah',
                'jenis_biaya' => 'biaya_tidak_langsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_kategori' => 'Perlengkapan Kantor',
                'jenis_biaya' => 'biaya_tidak_langsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_kategori' => 'Transportasi Guru',
                'jenis_biaya' => 'biaya_tidak_langsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
