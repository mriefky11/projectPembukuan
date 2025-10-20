<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Activity;
use App\Models\User;

class PemasukanSeeder extends Seeder
{
    public function run(): void
    {
        $bendaharaUsers = User::where('role', 'bendahara')->pluck('id')->toArray();
        $kegiatanList = Activity::all();

        $data = [];

        $entries = [
            ['Rapat Evaluasi Bulanan', 'Dana konsumsi rapat bulanan'],
            ['Pelatihan Literasi Digital', 'Sponsorship dari Dinas Pendidikan'],
            ['Pameran Karya Siswa', 'Uang pendaftaran peserta pameran'],
            ['Rapat Persiapan Akreditasi', 'Dana operasional rapat akreditasi'],
            ['Lomba Kebersihan Kelas', 'Donasi dari wali kelas'],
            ['Seminar Parenting', 'Tiket seminar dari orang tua siswa'],
            ['Workshop Kewirausahaan', 'Sponsor dari Bank BRI'],
            ['Peringatan Hari Guru Nasional', 'Donasi acara dari alumni'],
            ['Bakti Sosial di Panti Asuhan', 'Pengumpulan dana sukarela'],
            ['Pelatihan Kurikulum Merdeka batch 1', 'Dukungan dana dari yayasan'],
            ['Pelatihan Kurikulum Merdeka batch 2', 'Dana kegiatan pelatihan tahap 2'],
            ['Rapat Evaluasi Bulanan', 'Dana tambahan operasional rapat'],
            ['Workshop Kewirausahaan', 'Penjualan produk siswa'],
            ['Pameran Karya Siswa', 'Tiket masuk pengunjung pameran'],
            ['Seminar Parenting', 'Sponsor dari perusahaan lokal'],
            ['Bakti Sosial di Panti Asuhan', 'Bantuan dana dari masyarakat'],
            ['Pelatihan Literasi Digital', 'Pendanaan dari CSR perusahaan IT'],
            ['Lomba Kebersihan Kelas', 'Donasi dari OSIS'],
            ['Peringatan Hari Guru Nasional', 'Sumbangan sukarela guru dan staf'],
            ['Rapat Persiapan Akreditasi', 'Dana tambahan dokumentasi akreditasi'],
        ];

        foreach ($entries as $entry) {
            $kegiatan = $kegiatanList->firstWhere('name', $entry[0]);

            if ($kegiatan) {
                $data[] = [
                    'id' => Str::uuid(),
                    'kegiatan_id' => $kegiatan->id,
                    'tanggal' => fake()->dateTimeBetween($kegiatan->tanggal_mulai, $kegiatan->tanggal_selesai)->format('Y-m-d'),
                    'jumlah' => fake()->numberBetween(500000, 10000000),
                    'keterangan' => $entry[1],
                    'created_by' => fake()->randomElement($bendaharaUsers),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('pemasukan')->insert($data);
    }
}