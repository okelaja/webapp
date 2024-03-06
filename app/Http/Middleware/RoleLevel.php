<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleLevel
{
    // Fungsi ini buat mengekika request user kalau ada role nya 
    // kalau user itu ad role nya yang cocok maka di bolehkan 
    // untuk melakukan request selanjutnya

    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // kasih logika kalau user iru ada role nya yang cocok
        if (in_array($request->user()->role, $roles)) {
            return $next($request);
        }
          // ini kondisi dimna user itu tidak boleh melewati jalur itu
          return abort(403);
    }

}
