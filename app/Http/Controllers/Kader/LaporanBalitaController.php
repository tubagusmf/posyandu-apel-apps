<?php

namespace App\Http\Controllers\kader;

use App\Http\Controllers\Controller;
use App\Models\LayananBalita;
use Illuminate\Http\Request;

class LaporanBalitaController extends Controller
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
            'content' => 'kader.laporan-balita.index'
        ];

        return view('layout.wrapper', $data);
    }
}
