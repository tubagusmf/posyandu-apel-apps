<?php

namespace App\Http\Controllers\kader;

use App\Http\Controllers\Controller;
use App\Models\Rujukan;
use App\Models\LayananIbuHamil;
use Illuminate\Http\Request;

class RujukanKaderController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Rujukan Ibu Hamil',
            'rujukanList' => LayananIbuHamil::with(['ibu', 'kader'])
                ->where('kondisi', 'Kurang Baik')
                ->orderByDesc('tgl_kunjungan')
                ->get(),
            'content' => 'kader.rujukan-kader.index',
        ];

        return view('layout.wrapper', $data);
    }

    public function create($id)
    {
        $layanan = LayananIbuHamil::with(['ibu', 'kader'])->findOrFail($id);

        $noRujukan = now()->format('Ymd') . mt_rand(1000, 9999);

        $data = [
            'title' => 'Buat Rujukan',
            'layanan' => $layanan,
            'noRujukan' => $noRujukan,
            'content' => 'kader.rujukan-kader.create'
        ];
        return view('layout.wrapper', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'no_rujukan' => 'required|unique:tbl_rujukan',
            'nik_kader' => 'required',
            'nik_ibu_hamil' => 'required',
            'catatan_kesehatan' => 'required',
        ]);

        Rujukan::create([
            'no_rujukan' => $request->no_rujukan,
            'nik_kader' => $request->nik_kader,
            'nik_ibu_hamil' => $request->nik_ibu_hamil,
            'catatan_kesehatan' => $request->catatan_kesehatan,
            'tgl_rujukan' => now(),
        ]);

        return redirect()->route('kader.rujukan-kader')->with('success', 'Data berhasil ditambahkan.');
    }

    public function dataRujukan()
    {
        $data = [
            'title' => 'Data Rujukan',
            'rujukanList' => Rujukan::with(['kader', 'ibu'])->orderByDesc('tgl_rujukan')->get(),
            'content' => 'kader.rujukan-kader.data-rujukan',
        ];
        return view('layout.wrapper', $data);
    }

    public function edit($id)
    {
        $rujukan = Rujukan::with(['kader', 'ibu'])->findOrFail($id);
        $data = [
            'title' => 'Edit Rujukan',
            'rujukan' => $rujukan,
            'content' => 'kader.rujukan-kader.edit',
        ];
        return view('layout.wrapper', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'catatan_kesehatan' => 'required',
        ]);
    
        $rujukan = Rujukan::findOrFail($id);
        $rujukan->update([
            'catatan_kesehatan' => $request->catatan_kesehatan,
        ]);

        return redirect()->route('kader.rujukan-kader.data-rujukan')->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $rujukan = Rujukan::findOrFail($id);
        $rujukan->delete();
        return redirect()->route('kader.rujukan-kader.data-rujukan')->with('success', 'Data berhasil dihapus.');
    }
}
