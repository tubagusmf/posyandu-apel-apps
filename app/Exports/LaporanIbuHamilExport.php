<?php

namespace App\Exports;

use App\Models\LayananIbuHamil;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanIbuHamilExport implements FromView, WithStyles
{
    protected $bulan;

    public function __construct($bulan = null)
    {
        $this->bulan = $bulan;
    }

    public function view(): View
    {
        $query = LayananIbuHamil::with('ibu')->orderBy('tgl_kunjungan', 'desc');

        if ($this->bulan) {
            $query->whereMonth('tgl_kunjungan', date('m', strtotime($this->bulan)))
                  ->whereYear('tgl_kunjungan', date('Y', strtotime($this->bulan)));
        }

        return view('bidan.laporan-ibu-hamil.excel', [
            'laporanIbuHamil' => $query->get()
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount = LayananIbuHamil::count() + 1;
        $range = 'A1:F' . $rowCount;

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
