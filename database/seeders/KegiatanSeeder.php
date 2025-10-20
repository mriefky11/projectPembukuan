<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Activity;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id' => Str::uuid(),
                'name' => 'Rapat Evaluasi Bulanan',
                'deskripsi' => 'Kegiatan untuk membahas hasil kinerja bulan sebelumnya dan rencana perbaikan bulan depan.',
                'tanggal_mulai' => '2025-10-01',
                'tanggal_selesai' => '2025-10-01',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Pelatihan Literasi Digital',
                'deskripsi' => 'Pelatihan untuk meningkatkan kemampuan guru dan staf dalam penggunaan teknologi digital.',
                'tanggal_mulai' => '2025-10-05',
                'tanggal_selesai' => '2025-10-07',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Pameran Karya Siswa',
                'deskripsi' => 'Pameran hasil karya siswa dalam bidang seni, teknologi, dan kewirausahaan.',
                'tanggal_mulai' => '2025-10-10',
                'tanggal_selesai' => '2025-10-12',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Rapat Persiapan Akreditasi',
                'deskripsi' => 'Diskusi internal untuk persiapan dokumen dan kelengkapan akreditasi sekolah.',
                'tanggal_mulai' => '2025-10-14',
                'tanggal_selesai' => '2025-10-15',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Lomba Kebersihan Kelas',
                'deskripsi' => 'Kegiatan rutin untuk menjaga kebersihan dan keindahan ruang kelas.',
                'tanggal_mulai' => '2025-10-18',
                'tanggal_selesai' => '2025-10-18',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Seminar Parenting',
                'deskripsi' => 'Seminar untuk orang tua siswa mengenai peran keluarga dalam pendidikan anak.',
                'tanggal_mulai' => '2025-10-20',
                'tanggal_selesai' => '2025-10-20',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Workshop Kewirausahaan',
                'deskripsi' => 'Pelatihan keterampilan bisnis dan manajemen sederhana bagi siswa kelas akhir.',
                'tanggal_mulai' => '2025-10-22',
                'tanggal_selesai' => '2025-10-23',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Peringatan Hari Guru Nasional',
                'deskripsi' => 'Upacara dan acara apresiasi untuk menghormati para guru.',
                'tanggal_mulai' => '2025-11-25',
                'tanggal_selesai' => '2025-11-25',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Bakti Sosial di Panti Asuhan',
                'deskripsi' => 'Kegiatan sosial yang melibatkan siswa dan guru untuk membantu masyarakat sekitar.',
                'tanggal_mulai' => '2025-12-05',
                'tanggal_selesai' => '2025-12-05',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Pelatihan Kurikulum Merdeka batch 1',
                'deskripsi' => 'Workshop untuk guru dalam penerapan kurikulum merdeka di tahun ajaran baru.',
                'tanggal_mulai' => '2025-12-10',
                'tanggal_selesai' => '2025-12-12',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Pelatihan Kurikulum Merdeka batch 2',
                'deskripsi' => 'Workshop untuk guru dalam penerapan kurikulum merdeka di tahun ajaran baru.',
                'tanggal_mulai' => '2026-01-10',
                'tanggal_selesai' => '2026-01-12',
            ],
        ];

        foreach ($data as $dt) {
            Activity::create([
                'id' => $dt['id'],
                'name' => $dt['name'],
                'deskripsi' => $dt['deskripsi'],
                'tanggal_mulai' => $dt['tanggal_mulai'],
                'tanggal_selesai' => $dt['tanggal_selesai'],
            ]);
        }
    }
}
