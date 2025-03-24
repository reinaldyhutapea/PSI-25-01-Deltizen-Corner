<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login'); // Pastikan user sudah login
        }

        // Cek apakah user memiliki role yang sesuai
        if (!in_array(Auth::user()->role, $roles)) {
            return abort(403, 'Akses Ditolak'); // Gunakan 403 untuk Forbidden
        }

        return $next($request);
    }
}
