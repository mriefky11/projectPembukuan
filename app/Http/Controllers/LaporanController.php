<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Activity;
use App\Models\Income;
use App\Models\Spending;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $activities = Activity::all();

        $query = Laporan::with('kegiatan');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('kegiatan', fn($q) => $q->where('name', 'like', "%$search%"))
                  ->orWhere('periode', 'like', "%$search%");
        }

        $laporan = $query->latest()->paginate(10)->withQueryString();

        return view('laporan.index', compact('laporan','activities'));
    }


    public function generate(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'nullable|exists:kegiatan,id',
            'periode' => 'nullable|string',
        ]);

        $kegiatanId = $request->kegiatan_id;
        $periode = $request->periode;

        $generateSingle = function($kId, $periode) {
            $totalPemasukan = Income::where('kegiatan_id', $kId)
                ->when($periode, fn($q) => $q->where('tanggal', 'like', "$periode%"))
                ->sum('jumlah');

            $totalPengeluaranLangsung = Spending::where('kegiatan_id', $kId)
                ->whereHas('category', fn($q) => $q->where('jenis_biaya', 'biaya_langsung'))
                ->when($periode, fn($q) => $q->where('tanggal', 'like', "$periode%"))
                ->sum('jumlah');

            $totalPengeluaranTidakLangsung = Spending::where('kegiatan_id', $kId)
                ->whereHas('category', fn($q) => $q->where('jenis_biaya', 'biaya_tidak_langsung'))
                ->when($periode, fn($q) => $q->where('tanggal', 'like', "$periode%"))
                ->sum('jumlah');

            $totalPengeluaran = $totalPengeluaranLangsung + $totalPengeluaranTidakLangsung;
            $saldo = $totalPemasukan - $totalPengeluaran;

            Laporan::updateOrCreate(
                ['kegiatan_id' => $kId, 'periode' => $periode ?? date('Y-m')],
                [
                    'id' => Str::uuid(),
                    'total_pemasukan' => $totalPemasukan,
                    'total_pengeluaran_langsung' => $totalPengeluaranLangsung,
                    'total_pengeluaran_tidak_langsung' => $totalPengeluaranTidakLangsung,
                    'total_pengeluaran' => $totalPengeluaran,
                    'saldo' => $saldo,
                ]
            );
        };

        if ($kegiatanId && $periode) {
            $generateSingle($kegiatanId, $periode);
        } elseif ($kegiatanId) {
            $months = Income::where('kegiatan_id', $kegiatanId)
                ->orWhere('kegiatan_id', $kegiatanId)
                ->selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as bulan')
                ->distinct()
                ->pluck('bulan');

            foreach ($months as $bulan) {
                $generateSingle($kegiatanId, $bulan);
            }
        } elseif ($periode) {
            $kegiatans = Activity::whereHas('pemasukan', fn($q) => $q->where('tanggal', 'like', "$periode%"))
                ->orWhereHas('pengeluaran', fn($q) => $q->where('tanggal', 'like', "$periode%"))
                ->pluck('id');

            foreach ($kegiatans as $kId) {
                $this->generateSingle($kId, $periode);
            }
        } else {
            return back()->with('error', 'Pilih kegiatan atau periode terlebih dahulu.');
        }

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function download(Request $request, $format)
    {
        $laporan = Laporan::with('kegiatan')->get();

        if($format == 'xlsx'){
            return Excel::download(new LaporanExport($laporan), 'laporan.xlsx');
        } elseif($format == 'pdf'){
            $pdf = Pdf::loadView('laporan.pdf', compact('laporan'));
            return $pdf->download('laporan.pdf');
        } else {
            abort(404);
        }
    }

    public function destroy(Laporan $laporan)
    {
        $laporan->delete();
        return redirect()->route('laporan.index')->with('success', 'Data laporan berhasil dihapus.');
    }

    private function generateSingle($kegiatanId, $periode)
    {
        $totalPemasukan = Income::where('kegiatan_id', $kegiatanId)
            ->where('tanggal', 'like', "$periode%")
            ->sum('jumlah');

        $totalPengeluaranLangsung = Spending::where('kegiatan_id', $kegiatanId)
            ->whereHas('category', fn($q) => $q->where('jenis_biaya', 'biaya_langsung'))
            ->where('tanggal', 'like', "$periode%")
            ->sum('jumlah');

        $totalPengeluaranTidakLangsung = Spending::where('kegiatan_id', $kegiatanId)
            ->whereHas('category', fn($q) => $q->where('jenis_biaya', 'biaya_tidak_langsung'))
            ->where('tanggal', 'like', "$periode%")
            ->sum('jumlah');

        $totalPengeluaran = $totalPengeluaranLangsung + $totalPengeluaranTidakLangsung;
        $saldo = $totalPemasukan - $totalPengeluaran;

        Laporan::updateOrCreate(
            ['kegiatan_id' => $kegiatanId, 'periode' => $periode],
            [
                'id' => Str::uuid(),
                'total_pemasukan' => $totalPemasukan,
                'total_pengeluaran_langsung' => $totalPengeluaranLangsung,
                'total_pengeluaran_tidak_langsung' => $totalPengeluaranTidakLangsung,
                'total_pengeluaran' => $totalPengeluaran,
                'saldo' => $saldo
            ]
        );
    }

}
