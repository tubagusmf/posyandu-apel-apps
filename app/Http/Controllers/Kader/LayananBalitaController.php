<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\LayananBalita;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayananBalitaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Layanan Balita',
            'layananBalita' => LayananBalita::with(['anak'])->get(),
            'anakList' => Anak::all(),
            'content' => 'kader.layanan-balita.index'
        ];

        return view('layout.wrapper', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Layanan Balita',
            'anakList' => Anak::all(),
            'content' => 'kader.layanan-balita.create'
        ];
        return view('layout.wrapper', $data);
    }

    public function store(Request $request)
{
    $request->validate([
        'nik_anak' => 'required',
        'bb_anak' => 'required|numeric',
        'tb_anak' => 'required|numeric',
        'lk_anak' => 'required|numeric',
        'lila_anak' => 'required|numeric',
        'imunisasi' => 'required|string',
        'tgl_imunisasi' => 'required|date',
        'catatan_kesehatan' => 'nullable|string',
    ]);

    LayananBalita::create([
        'nik_anak' => $request->nik_anak,
        'nik_kader' => Auth::guard('kader')->user()->nik_kader,
        'bb_anak' => $request->bb_anak,
        'tb_anak' => $request->tb_anak,
        'lk_anak' => $request->lk_anak,
        'lila_anak' => $request->lila_anak,
        'imunisasi' => $request->imunisasi,
        'tgl_imunisasi' => $request->tgl_imunisasi,
        'catatan_kesehatan' => $request->catatan_kesehatan,
        'tgl_kunjungan' => now(), 
    ]);

    return redirect()->route('kader.layanan-balita')->with('success', 'Data berhasil ditambahkan.');
}


    public function edit($id)
    {
        $data = [
            'title' => 'Edit Layanan Balita',
            'layananBalita' => LayananBalita::findOrFail($id),
            'anakList' => Anak::all(),
            'content' => 'kader.layanan-balita.edit'
        ];
        return view('layout.wrapper', $data);
    }

    public function update(Request $request, $id)
{
    $layanan = LayananBalita::findOrFail($id);

    $request->validate([
        'nik_anak' => 'required',
        'bb_anak' => 'required|numeric',
        'tb_anak' => 'required|numeric',
        'lk_anak' => 'required|numeric',
        'lila_anak' => 'required|numeric',
        'imunisasi' => 'required|string',
        'tgl_imunisasi' => 'required|date',
        'catatan_kesehatan' => 'nullable|string',
    ]);

    $layanan->update([
        'nik_anak' => $request->nik_anak,
        'nik_kader' => Auth::guard('kader')->user()->nik_kader,
        'bb_anak' => $request->bb_anak,
        'tb_anak' => $request->tb_anak,
        'lk_anak' => $request->lk_anak,
        'lila_anak' => $request->lila_anak,
        'imunisasi' => $request->imunisasi,
        'tgl_imunisasi' => $request->tgl_imunisasi,
        'catatan_kesehatan' => $request->catatan_kesehatan,
        'tgl_kunjungan' => now(),
    ]);

    return redirect()->route('kader.layanan-balita')->with('success', 'Data berhasil diperbarui.');
}


    public function destroy($id)
    {
        $layanan = LayananBalita::findOrFail($id);
        $layanan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}