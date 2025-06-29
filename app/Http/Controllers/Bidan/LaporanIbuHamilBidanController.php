<?php

namespace App\Http\Controllers\bidan;

use App\Http\Controllers\Controller;
use App\Models\LayananIbuHamil;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class LaporanIbuHamilBidanController extends Controller
{
    public function index(Request $request)
    {
        $query = LayananIbuHamil::with('ibu')->orderBy('tgl_kunjungan', 'desc');

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
            'title' => 'Laporan Ibu Hamil',
            'laporanIbuHamil' => $query->get(),
            'content' => 'bidan.laporan-ibu-hamil.index'
        ];

        return view('layout.wrapper', $data);
    }

    public function exportPdf(Request $request)
    {
        $query = LayananIbuHamil::with('ibu')->orderBy('tgl_kunjungan', 'desc');

        if ($request->has('bulan') && $request->bulan != '') {
            $query->whereMonth('tgl_kunjungan', date('m', strtotime($request->bulan)))
                ->whereYear('tgl_kunjungan', date('Y', strtotime($request->bulan)));
        }

        $laporanIbuHamil = $query->get();

        $pdf = PDF::loadView('bidan.laporan-ibu-hamil.pdf', compact('laporanIbuHamil'));

        $tanggalSekarang = Carbon::now()->format('Y-m-d');
        $namaFile = 'laporan_ibu_hamil_' . $tanggalSekarang . '.pdf';

        return $pdf->download($namaFile);
    }
}
