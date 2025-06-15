<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardKaderController extends Controller
{
    public function index()
    {
        $kader = Auth::guard('kader')->user();
        $data = [
            'title' => 'Dashboard Kader',
            'content' => 'kader/dashboard'
        ];
        return view('layout.wrapper', compact('kader'), $data);
    }
}
