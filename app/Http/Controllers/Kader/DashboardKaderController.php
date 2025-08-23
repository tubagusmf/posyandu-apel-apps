<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Anak;
use App\Models\IbuHamil;
use Carbon\Carbon;

class DashboardKaderController extends Controller
{
    public function index()
    {
        $kader = Auth::guard('kader')->user();
        
        $now = Carbon::now();

        $balita0_12 = Anak::whereRaw('TIMESTAMPDIFF(MONTH, tgl_lahir, ?) BETWEEN 0 AND 12', [$now])->count();
        $balita13_36 = Anak::whereRaw('TIMESTAMPDIFF(MONTH, tgl_lahir, ?) BETWEEN 13 AND 36', [$now])->count();
        $balita37_60 = Anak::whereRaw('TIMESTAMPDIFF(MONTH, tgl_lahir, ?) BETWEEN 37 AND 60', [$now])->count();

        $ibuHamil = IbuHamil::count();

        $data = [
            'title' => 'Dashboard Kader',
            'content' => 'kader/dashboard',
            'balita0_12' => $balita0_12,
            'balita13_36' => $balita13_36,
            'balita37_60' => $balita37_60,
            'ibuHamil' => $ibuHamil,
        ];

        return view('layout.wrapper', compact('kader'), $data);
    }
}
