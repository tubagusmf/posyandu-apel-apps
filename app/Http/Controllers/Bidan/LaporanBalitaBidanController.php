<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\LayananBalita;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use App\Exports\LaporanBalitaExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanBalitaBidanController extends Controller
{
    public function index(Request $request)
    {

        $query = LayananBalita::with('anak')->orderBy('tgl_kunjungan', 'desc');

        if ($request->has('bulan') && $request->bulan != '') {
            try {
                $bulan = $request->bulan;
                $query->whereMonth('tgl_kunjungan', '=', date('m', strtotime($bulan)))
                    ->whereYear('tgl_kunjungan', '=', date('Y', strtotime($bulan)));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Format bulan tidak valid.');
            }
        }

        $data = [
            'title' => 'Laporan Balita',
            'laporanBalita' => $query->get(),
            'content' => 'bidan.laporan-balita.index'
        ];

        return view('layout.wrapper', $data);
    }

    public function exportPdf(Request $request)
    {
        $query = LayananBalita::with('anak')->orderBy('tgl_kunjungan', 'desc');

        if ($request->has('bulan') && $request->bulan != '') {
            $query->whereMonth('tgl_kunjungan', date('m', strtotime($request->bulan)))
                ->whereYear('tgl_kunjungan', date('Y', strtotime($request->bulan)));
        }

        $laporanBalita = $query->get();

        $pdf = PDF::loadView('bidan.laporan-balita.pdf', compact('laporanBalita'));

        $tanggalSekarang = Carbon::now()->format('Y-m-d_H-i-s');
        $namaFile = 'laporan_balita_' . $tanggalSekarang . '.pdf';

        return $pdf->download($namaFile);
    }

    public function exportExcel(Request $request)
    {
        $tanggalSekarang = now()->format('Y-m-d_H-i-s'); // Format dengan jam:menit:detik
        $namaFile = 'laporan_balita_' . $tanggalSekarang . '.xlsx';

        return Excel::download(new LaporanBalitaExport($request->bulan), $namaFile);
    }
}