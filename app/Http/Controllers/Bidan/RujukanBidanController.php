<?php

namespace App\Http\Controllers\bidan;

use App\Http\Controllers\Controller;
use App\Models\Rujukan;
use Illuminate\Http\Request;
use PDF;

class RujukanBidanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Rujukan',
            'rujukanList' => Rujukan::with(['kader', 'ibu'])->orderByDesc('tgl_rujukan')->get(),
            'content' => 'bidan.rujukan-bidan.index',
        ];
        
        return view('layout.wrapper', $data);
    }

    public function downloadPdf($id)
    {
        $rujukan = Rujukan::with(['kader', 'ibu'])->findOrFail($id);
        $bidan = auth('bidan')->user();

        $pdf = Pdf::loadView('bidan.rujukan-bidan.pdf', compact('rujukan', 'bidan'))->setPaper('A4', 'portrait');
        return $pdf->download('Surat-Rujukan-' . $rujukan->no_rujukan . '.pdf');
    }

    public function printPdf($id)
    {
        $rujukan = Rujukan::with(['kader', 'ibu'])->findOrFail($id);
        $bidan = auth('bidan')->user();

        $pdf = Pdf::loadView('bidan.rujukan-bidan.pdf', compact('rujukan', 'bidan'))->setPaper('A4', 'portrait');
        return $pdf->stream('Surat-Rujukan-' . $rujukan->no_rujukan . '.pdf');
    }
}
