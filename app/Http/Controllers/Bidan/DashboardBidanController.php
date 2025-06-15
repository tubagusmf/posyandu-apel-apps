<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardBidanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Bidan',
            'content' => 'bidan/dashboard'
        ];
        return view('layout.wrapper', $data);
    }

}
