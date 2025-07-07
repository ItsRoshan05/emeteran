<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Mendukung format middleware:
     * - role:admin
     * - role:admin,petugas
     * - role:admin|petugas
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Gabungkan semua role jika ada pemisah '|' seperti role:admin|petugas
        $allowedRoles = [];

        foreach ($roles as $role) {
            $parts = explode('|', $role);
            $allowedRoles = array_merge($allowedRoles, $parts);
        }

        if (!in_array($user->role, $allowedRoles)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
