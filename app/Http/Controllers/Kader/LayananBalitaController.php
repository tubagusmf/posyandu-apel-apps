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

        $layanan = LayananBalita::create([
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

        $statusGizi = $this->klasifikasiClusterGizi($layanan->id);
        $layanan->update(['status_gizi' => $statusGizi]);

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
        ]);

        $statusGizi = $this->klasifikasiClusterGizi($layanan->id);
        $layanan->update(['status_gizi' => $statusGizi]);

        return redirect()->route('kader.layanan-balita')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $layanan = LayananBalita::findOrFail($id);
        $layanan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    private function klasifikasiClusterGizi($id)
    {
        $data = LayananBalita::all();

        if ($data->count() < 3) {
            return null;
        }

        $points = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'bb' => $item->bb_anak,
                'tb' => $item->tb_anak,
                'lk' => $item->lk_anak,
            ];
        })->toArray();

        $max = [
            'bb' => max(array_column($points, 'bb')),
            'tb' => max(array_column($points, 'tb')),
            'lk' => max(array_column($points, 'lk')),
        ];

        foreach ($points as &$p) {
            $p['bb'] /= $max['bb'];
            $p['tb'] /= $max['tb'];
            $p['lk'] /= $max['lk'];
        }
        unset($p);

        $centroids = array_map(fn($p) => [
            'bb' => $p['bb'],
            'tb' => $p['tb'],
            'lk' => $p['lk'],
        ], array_slice($points, 0, 3));

        $changed = true;
        $clusters = [0 => [], 1 => [], 2 => []];

        while ($changed) {
            $changed = false;
            $clusters = [0 => [], 1 => [], 2 => []];

            foreach ($points as $point) {
                $distances = array_map(fn($c) => sqrt(
                    pow($point['bb'] - $c['bb'], 2) +
                    pow($point['tb'] - $c['tb'], 2) +
                    pow($point['lk'] - $c['lk'], 2)
                ), $centroids);

                $idx = array_search(min($distances), $distances);
                $clusters[$idx][] = $point;
            }

            foreach ($clusters as $i => $cluster) {
                if (empty($cluster)) continue;
                $newCentroid = [
                    'bb' => array_sum(array_column($cluster, 'bb')) / count($cluster),
                    'tb' => array_sum(array_column($cluster, 'tb')) / count($cluster),
                    'lk' => array_sum(array_column($cluster, 'lk')) / count($cluster),
                ];

                if (
                    round($centroids[$i]['bb'], 4) !== round($newCentroid['bb'], 4) ||
                    round($centroids[$i]['tb'], 4) !== round($newCentroid['tb'], 4) ||
                    round($centroids[$i]['lk'], 4) !== round($newCentroid['lk'], 4)
                ) {
                    $centroids[$i] = $newCentroid;
                    $changed = true;
                }
            }
        }

        $avgBB = array_map(fn($c) => array_sum(array_column($c, 'bb')) / count($c), $clusters);
        asort($avgBB);
        $sortedKeys = array_keys($avgBB);
        $labelMap = [
            $sortedKeys[0] => 'Gizi Kurang',
            $sortedKeys[1] => 'Gizi Baik',
            $sortedKeys[2] => 'Gizi Lebih',
        ];

        $targetStatus = null;
        foreach ($clusters as $i => $cluster) {
            foreach ($cluster as $point) {
                $status = $labelMap[$i];
                LayananBalita::where('id', $point['id'])->update([
                    'status_gizi' => $status,
                ]);

                if ($point['id'] == $id) {
                    $targetStatus = $status;
                }
            }
        }

        return $targetStatus;
    }
}