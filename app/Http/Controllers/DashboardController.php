<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $files = Storage::files('backups');
        $lastBackup = !empty($files)
            ? date('d-m-Y H:i:s', Storage::lastModified(end($files)))
            : null;

        if (in_array($user->role, ['bendahara', 'kepala_sekolah', 'yayasan']))  {
            $totalPemasukan = DB::table('pemasukan')->sum('jumlah');
            $totalPengeluaran = DB::table('pengeluaran')->sum('jumlah');

            $totalBiayaLangsung = DB::table('pengeluaran as p')
                ->join('kategori_biaya as k', 'p.kategori_id', '=', 'k.id')
                ->where('k.jenis_biaya', 'biaya_langsung')
                ->sum('p.jumlah');

            $totalBiayaTidakLangsung = DB::table('pengeluaran as p')
                ->join('kategori_biaya as k', 'p.kategori_id', '=', 'k.id')
                ->where('k.jenis_biaya', 'biaya_tidak_langsung')
                ->sum('p.jumlah');

            $totalKegiatan = DB::table('kegiatan')->count();
            $totalSaldo = $totalPemasukan - $totalPengeluaran;

            return view('dashboard.index', compact(
                'user',
                'totalPemasukan',
                'totalPengeluaran',
                'totalBiayaLangsung',
                'totalBiayaTidakLangsung',
                'totalKegiatan',
                'totalSaldo',
                'lastBackup'
            ));
        } else {
            // === Data untuk operator ===
            $jumlahPengguna = DB::table('users')->count();
            $tanggalHariIni = now()->format('d-m-Y');

            return view('dashboard.operator', compact(
                'user',
                'jumlahPengguna',
                'tanggalHariIni',
                'lastBackup'
            ));
        }
    }
}
