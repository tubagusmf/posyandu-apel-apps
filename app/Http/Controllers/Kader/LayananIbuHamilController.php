<?php

namespace App\Http\Controllers\kader;

use App\Http\Controllers\Controller;
use App\Models\LayananIbuHamil;
use App\Models\IbuHamil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayananIbuHamilController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Layanan Ibu Hamil',
            'layananIbu' => LayananIbuHamil::with(['ibu'])->get(),
            'ibuList' => IbuHamil::all(),
            'content' => 'kader.layanan-ibu-hamil.index'
        ];
        return view('layout.wrapper', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Layanan Ibu Hamil',
            'ibuList' => IbuHamil::all(),
            'content' => 'kader.layanan-ibu-hamil.create'
        ];
        return view('layout.wrapper', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik_ibu_hamil' => 'required|exists:tbl_data_ibu_hamil,nik_ibu_hamil',
            'tensi' => 'required|string|max:30',
            'bb_ibu_hamil' => 'required|numeric|min:0',
            'usia_hamil' => 'required|string|max:20',
        ]);

        preg_match('/\d+/', $request->usia_hamil, $matches);
        $usia = isset($matches[0]) ? (int) $matches[0] : 0;

        $historiTerakhir = LayananIbuHamil::where('nik_ibu_hamil', $request->nik_ibu_hamil)
            ->orderByDesc('tgl_kunjungan')
            ->first();

        $bbSebelum = $historiTerakhir ? $historiTerakhir->bb_ibu_hamil : 0;

        $kondisi = $request->bb_ibu_hamil > $bbSebelum ? 'Baik' : 'Kurang Baik';

        LayananIbuHamil::create([
            'nik_ibu_hamil' => $request->nik_ibu_hamil,
            'nik_kader' => Auth::guard('kader')->user()->nik_kader,
            'tensi' => $request->tensi,
            'bb_ibu_hamil' => $request->bb_ibu_hamil,
            'usia_hamil' => $request->usia_hamil,
            'kondisi' => $kondisi,
            'tgl_kunjungan' => now(),
        ]);

        return redirect()->route('kader.layanan-ibu-hamil')
            ->with('success', 'Data layanan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $data = [
            'title' => 'Detail Layanan Ibu Hamil',
            'layananIbuHamil' => LayananIbuHamil::findOrFail($id),
            'ibuList' => IbuHamil::all(),
            'content' => 'kader.layanan-ibu-hamil.show'
        ];
        return view('layout.wrapper', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Layanan Ibu Hamil',
            'layananIbuHamil' => LayananIbuHamil::findOrFail($id),
            'ibuList' => IbuHamil::all(),
            'content' => 'kader.layanan-ibu-hamil.edit'
        ];
        return view('layout.wrapper', $data);
    }

    public function update(Request $request, $id)
    {
        $layanan = LayananIbuHamil::findOrFail($id);

        $request->validate([
            'nik_ibu_hamil' => 'required|exists:tbl_data_ibu_hamil,nik_ibu_hamil',
            'tensi' => 'required|string|max:30',
            'bb_ibu_hamil' => 'required|numeric|min:0',
            'usia_hamil' => 'required|string|max:20',
        ]);

        preg_match('/\d+/', $request->usia_hamil, $matches);
        $usia = isset($matches[0]) ? (int) $matches[0] : 0;

        $historiTerakhir = LayananIbuHamil::where('nik_ibu_hamil', $request->nik_ibu_hamil)
            ->where('id', '<>', $layanan->id)
            ->orderByDesc('tgl_kunjungan')
            ->first();

        $bbSebelum = $historiTerakhir ? $historiTerakhir->bb_ibu_hamil : 0;

        $kondisi = $request->bb_ibu_hamil > $bbSebelum ? 'Baik' : 'Kurang Baik';

        $layanan->update([
            'nik_ibu_hamil' => $request->nik_ibu_hamil,
            'nik_kader' => Auth::guard('kader')->user()->nik_kader,
            'tensi' => $request->tensi,
            'bb_ibu_hamil' => $request->bb_ibu_hamil,
            'usia_hamil' => $request->usia_hamil,
            'kondisi' => $kondisi,
            'tgl_kunjungan' => now(),
        ]);

        return redirect()->route('kader.layanan-ibu-hamil')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $layanan = LayananIbuHamil::findOrFail($id);
        $layanan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function rujukan()
    {
        // Ambil layanan dengan kondisi "Kurang Baik", sudah termasuk data ibu & kader
        $data = [
            'title' => 'Riwayat Rujukan Ibu Hamil',
            'rujukanList' => LayananIbuHamil::with(['ibu', 'kader'])
                ->where('kondisi', 'Kurang Baik')
                ->orderByDesc('tgl_kunjungan')
                ->get(),
            'content' => 'kader.layanan-ibu-hamil.rujukan',
        ];

        return view('layout.wrapper', $data);
    }


}

