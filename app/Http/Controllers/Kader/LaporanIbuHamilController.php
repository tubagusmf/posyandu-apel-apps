<?php

namespace App\Http\Controllers\kader;

use App\Http\Controllers\Controller;
use App\Models\LayananIbuHamil;
use Illuminate\Http\Request;

class LaporanIbuHamilController extends Controller
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
            'content' => 'kader.laporan-ibu-hamil.index'
        ];

        return view('layout.wrapper', $data);
    }
}
