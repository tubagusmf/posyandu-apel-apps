<?php

namespace App\Exports;

use App\Models\LayananBalita;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanBalitaExport implements FromView, WithStyles
{
    protected $bulan;

    public function __construct($bulan = null)
    {
        $this->bulan = $bulan;
    }

    public function view(): View
    {
        $query = LayananBalita::with('anak')->orderBy('tgl_kunjungan', 'desc');

        if ($this->bulan) {
            $query->whereMonth('tgl_kunjungan', date('m', strtotime($this->bulan)))
                  ->whereYear('tgl_kunjungan', date('Y', strtotime($this->bulan)));
        }

        return view('bidan.laporan-balita.excel', [
            'laporanBalita' => $query->get()
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount = LayananBalita::count() + 1;
        $range = 'A1:J' . $rowCount;

        return [
            $range => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],
        ];
    }
}
