<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Activity;
use App\Models\CategoryCost;
use App\Models\User;

class PengeluaranSeeder extends Seeder
{
    public function run(): void
    {
        $bendaharaUsers = User::where('role', 'bendahara')->pluck('id')->toArray();
        $kegiatanList = Activity::all();
        $kategoriList = CategoryCost::all();

        $data = [];

        $entries = [
            ['Rapat Evaluasi Bulanan', 'Konsumsi rapat bulanan', 'Konsumsi Guru dan Pegawai'],
            ['Pelatihan Literasi Digital', 'Pembelian alat dan ATK pelatihan', 'Perlengkapan Kantor'],
            ['Pameran Karya Siswa', 'Sewa tenda dan dekorasi pameran', 'Kegiatan Tahunan Sekolah'],
            ['Rapat Persiapan Akreditasi', 'Cetak dokumen akreditasi', 'Perlengkapan Kantor'],
            ['Lomba Kebersihan Kelas', 'Pembelian alat kebersihan', 'Pemeliharaan Fasilitas Sekolah'],
            ['Seminar Parenting', 'Honor narasumber seminar', 'Transportasi Guru'],
            ['Workshop Kewirausahaan', 'Pembelian bahan praktek kewirausahaan', 'Kegiatan Tahunan Sekolah'],
            ['Peringatan Hari Guru Nasional', 'Konsumsi dan souvenir acara', 'Konsumsi Guru dan Pegawai'],
            ['Bakti Sosial di Panti Asuhan', 'Transportasi dan konsumsi relawan', 'Transportasi Guru'],
            ['Pelatihan Kurikulum Merdeka batch 1', 'Cetak modul pelatihan', 'Perlengkapan Kantor'],
            ['Pelatihan Kurikulum Merdeka batch 2', 'Honor narasumber pelatihan', 'Transportasi Guru'],
            ['Pameran Karya Siswa', 'Konsumsi panitia pameran', 'Konsumsi Guru dan Pegawai'],
            ['Lomba Kebersihan Kelas', 'Hadiah lomba kebersihan', 'Kegiatan Tahunan Sekolah'],
            ['Workshop Kewirausahaan', 'Transportasi pembicara', 'Transportasi Guru'],
            ['Seminar Parenting', 'Sewa sound system dan dokumentasi', 'Pemeliharaan Fasilitas Sekolah'],
            ['Rapat Evaluasi Bulanan', 'Pembelian alat tulis kantor', 'Perlengkapan Kantor'],
            ['Pelatihan Literasi Digital', 'Konsumsi peserta pelatihan', 'Konsumsi Guru dan Pegawai'],
            ['Peringatan Hari Guru Nasional', 'Dekorasi panggung dan banner acara', 'Kegiatan Tahunan Sekolah'],
            ['Bakti Sosial di Panti Asuhan', 'Pembelian paket sembako', 'Kegiatan Tahunan Sekolah'],
            ['Pelatihan Kurikulum Merdeka batch 1', 'Sewa ruang pelatihan', 'Listrik & Air'],
        ];

        foreach ($entries as $entry) {
            $kegiatan = $kegiatanList->firstWhere('name', $entry[0]);
            $kategori = $kategoriList->firstWhere('nama_kategori', $entry[2]);

            if ($kegiatan && $kategori) {
                $data[] = [
                    'id' => Str::uuid(),
                    'kegiatan_id' => $kegiatan->id,
                    'kategori_id' => $kategori->id,
                    'created_by' => fake()->randomElement($bendaharaUsers),
                    'tanggal' => fake()->dateTimeBetween($kegiatan->tanggal_mulai, $kegiatan->tanggal_selesai)->format('Y-m-d'),
                    'jumlah' => fake()->numberBetween(300000, 8000000),
                    'keterangan' => $entry[1],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('pengeluaran')->insert($data);
    }
}
