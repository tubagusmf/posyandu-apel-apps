<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->is('dashboard-kader') || $request->is('kader/*')) {
            return route('login.kader'); // ← sesuaikan dengan route yang kamu buat
        }

        if ($request->is('dashboard-bidan') || $request->is('bidan/*')) {
            return route('login.bidan'); // ← sesuaikan dengan route yang kamu buat
        }
    
        return route('login');
    }
}
