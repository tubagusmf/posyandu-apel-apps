<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\LayananBalita;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class LayananBalitaController extends Controller
{

    private $standarWHO_LakiLaki = [
        0  => [2.5, 3.3, 4.4],
        1  => [3.4, 4.5, 5.8],
        2  => [4.3, 5.6, 7.1],
        3  => [5.0, 6.4, 8.0],
        4  => [5.6, 7.0, 8.7],
        5  => [6.0, 7.5, 9.3],
        6  => [6.4, 7.9, 9.8],
        7  => [6.7, 8.3, 10.3],
        8  => [6.9, 8.6, 10.7],
        9  => [7.1, 8.9, 11.0],
        10 => [7.4, 9.2, 11.4],
        11 => [7.6, 9.4, 11.7],
        12 => [7.7, 9.6, 12.0],
        13 => [7.9, 9.9, 12.3],
        14 => [8.1, 10.1, 12.6],
        15 => [8.3, 10.3, 12.8],
        16 => [8.4, 10.5, 13.1],
        17 => [8.6, 10.7, 13.4],
        18 => [8.8, 10.9, 13.7],
        19 => [8.9, 11.1, 13.9],
        20 => [9.1, 11.3, 14.2],
        21 => [9.2, 11.5, 14.5],
        22 => [9.4, 11.8, 14.7],
        23 => [9.5, 12.0, 15.0],
        24 => [9.7, 12.2, 15.3],
    ];

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

    private function getUmurBulan($anak)
    {
        if (!$anak || !$anak->tgl_lahir) return 0;

        $umurBulan = \Carbon\Carbon::parse($anak->tgl_lahir)->diffInMonths(\Carbon\Carbon::now());

        return min(max($umurBulan, 0), 24); 
    }

    private function getWHOStatus($umurBulan, $bb)
    {
        $standar = $this->standarWHO_LakiLaki[$umurBulan] ?? null;
        if (!$standar) return null;

        [$min, $median, $max] = $standar;

        if ($bb <= $min) return 'Gizi Kurang';
        if ($bb >= $max) return 'Gizi Lebih';
        return 'Gizi Baik';
    }

    private function klasifikasiClusterGizi($id)
    {
        $data = LayananBalita::with('anak')->get();
        if ($data->count() < 3) return null;

        $points = $data->map(fn($item) => [
            'id' => $item->id,
            'bb' => $item->bb_anak,
            'tb' => $item->tb_anak,
            'lk' => $item->lk_anak,
        ])->toArray();

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
            'bb' => $p['bb'], 'tb' => $p['tb'], 'lk' => $p['lk']
        ], array_slice($points, 0, 3));

        Log::info("Centroid Awal", $centroids);

        $changed = true;
        $iteration = 0;

        while ($changed) {
            $iteration++;
            $changed = false;
            $clusters = [0 => [], 1 => [], 2 => []];

            foreach ($points as $point) {
                $distances = array_map(fn($c) => sqrt(
                    pow($point['bb'] - $c['bb'], 2) +
                    pow($point['tb'] - $c['tb'], 2) +
                    pow($point['lk'] - $c['lk'], 2)
                ), $centroids);

                Log::info("Iterasi {$iteration} - Point ID {$point['id']} - Jarak ke Centroid", $distances);

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

                Log::info("Iterasi {$iteration} - Update Centroid {$i}", $newCentroid);

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

        $avgBB = array_map(fn($c) => count($c) ? array_sum(array_column($c, 'bb')) / count($c) : 0, $clusters);
        asort($avgBB);
        $sortedKeys = array_keys($avgBB);
        $labelMap = [
            $sortedKeys[0] => 'Gizi Kurang',
            $sortedKeys[1] => 'Gizi Baik',
            $sortedKeys[2] => 'Gizi Lebih',
        ];

        Log::info("Label Mapping (avgBB):", $labelMap);

        $targetStatus = null;
        foreach ($clusters as $i => $cluster) {
            foreach ($cluster as $point) {
                $layanan = $data->firstWhere('id', $point['id']);
                $umurBulan = $this->getUmurBulan($layanan->anak);
                $bb = $layanan->bb_anak;
                $status = $this->getWHOStatus($umurBulan, $bb) ?? $labelMap[$i];

                Log::info("Point ID {$point['id']} | Umur: {$umurBulan} bulan | BB: {$bb} kg | Status: {$status}");

                LayananBalita::where('id', $point['id'])->update(['status_gizi' => $status]);
                if ($point['id'] == $id) $targetStatus = $status;
            }
        }

        return $targetStatus;
    }
}