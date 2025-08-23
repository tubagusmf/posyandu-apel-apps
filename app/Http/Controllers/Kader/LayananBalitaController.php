<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\LayananBalita;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Data\StandarWHO;

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

    private function getUmurBulan($anak)
    {
        if (!$anak || !$anak->tgl_lahir) return 0;

        $umurBulan = \Carbon\Carbon::parse($anak->tgl_lahir)->diffInMonths(\Carbon\Carbon::now());

        return min(max($umurBulan, 0), 60); 
    }

    private function getWHOStatus($umurBulan, $bb, $jenisKelamin = 'L')
    {
        $data = StandarWHO::get();

        if (!isset($data[$jenisKelamin][$umurBulan])) {
            \Log::warning("Data WHO tidak ditemukan untuk JK={$jenisKelamin} dan umur={$umurBulan}");
            return null;
        }

        [$min, $median, $max] = $data[$jenisKelamin][$umurBulan];

        if ($bb <= $min) return 'Gizi Kurang';
        if ($bb >= $max) return 'Gizi Lebih';

        return 'Gizi Normal';
    }


    public function klasifikasiClusterGizi($id)
    {
        $data = LayananBalita::with('anak')->get();
        if ($data->count() < 3) return null;

        $points = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'bb' => $item->bb_anak,
                'umur' => $this->getUmurBulan($item->anak),
            ];
        })->toArray();

        $max = [
            'bb' => max(array_column($points, 'bb')),
            'umur' => max(array_column($points, 'umur')),
        ];

        foreach ($points as &$p) {
            $p['bb'] /= $max['bb'];
            $p['umur'] /= $max['umur'];
        }
        unset($p);

        $centroids = array_map(fn($p) => [
            'bb' => $p['bb'], 'umur' => $p['umur']
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
                    pow($point['umur'] - $c['umur'], 2)
                ), $centroids);

                Log::info("Iterasi {$iteration} - Point ID {$point['id']} - Jarak ke Centroid", $distances);

                $idx = array_search(min($distances), $distances);
                $clusters[$idx][] = $point;
            }

            foreach ($clusters as $i => $cluster) {
                if (empty($cluster)) continue;

                $newCentroid = [
                    'bb' => array_sum(array_column($cluster, 'bb')) / count($cluster),
                    'umur' => array_sum(array_column($cluster, 'umur')) / count($cluster),
                ];

                Log::info("Iterasi {$iteration} - Update Centroid {$i}", $newCentroid);

                if (
                    round($centroids[$i]['bb'], 4) !== round($newCentroid['bb'], 4) ||
                    round($centroids[$i]['umur'], 4) !== round($newCentroid['umur'], 4)
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
            $sortedKeys[1] => 'Gizi Normal',
            $sortedKeys[2] => 'Gizi Lebih',
        ];

        Log::info("Label Mapping (avgBB):", $labelMap);

        $targetStatus = null;
        foreach ($clusters as $i => $cluster) {
            foreach ($cluster as $point) {
                $layanan = $data->firstWhere('id', $point['id']);
                $umurBulan = $point['umur'] * $max['umur'];
                $bb = $point['bb'] * $max['bb'];
                $jk = strtolower($layanan->anak->jenis_kelamin) === 'perempuan' ? 'P' : 'L';
                $status = $this->getWHOStatus(round($umurBulan), round($bb, 1), $jk) ?? $labelMap[$i];

                Log::info("Point ID {$point['id']} | Umur: " . round($umurBulan) . " bulan | BB: " . round($bb, 1) . " kg | Status: {$status}");

                LayananBalita::where('id', $point['id'])->update(['status_gizi' => $status]);
                if ($point['id'] == $id) $targetStatus = $status;
            }
        }

        return $targetStatus;
    }
}