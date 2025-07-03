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
        if (!$request->expectsJson()) {
            session()->flash('error', 'Maaf, Anda harus login terlebih dahulu.');

            if ($request->is('dashboard-kader') || $request->is('kader/*')) {
                return route('login.kader'); 
            }

            if ($request->is('dashboard-bidan') || $request->is('bidan/*')) {
                return route('login.bidan');
            }

            return route('login');
        }
        
        return null;
    }
}
