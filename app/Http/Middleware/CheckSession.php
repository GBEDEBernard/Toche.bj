<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSession
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', '⏳ Votre session a expiré, veuillez vous reconnecter.');
        }

        return $next($request);
    }
}
