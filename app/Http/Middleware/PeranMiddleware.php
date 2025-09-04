<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PeranMiddleware
{
    public function handle(Request $request, Closure $next, $peran): Response
    {
        $user = auth()->user();
        
        if (!$user || $user->role !== $peran) {
            abort(403, 'Akses ditolak.');
        }
        
        return $next($request);
    }
}