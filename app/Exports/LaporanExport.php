<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    protected $laporan;

    public function __construct($laporan)
    {
        $this->laporan = $laporan;
    }

    public function collection()
    {
        return $this->laporan->map(fn($item) => [
            'Kegiatan' => $item->kegiatan->name,
            'Periode' => $item->periode,
            'Total Pemasukan' => $item->total_pemasukan,
            'Pengeluaran Langsung' => $item->total_pengeluaran_langsung,
            'Pengeluaran Tidak Langsung' => $item->total_pengeluaran_tidak_langsung,
            'Total Pengeluaran' => $item->total_pengeluaran,
            'Saldo' => $item->saldo
        ]);
    }

    public function headings(): array
    {
        return [
            'Kegiatan',
            'Periode',
            'Total Pemasukan',
            'Pengeluaran Langsung',
            'Pengeluaran Tidak Langsung',
            'Total Pengeluaran',
            'Saldo'
        ];
    }
}
