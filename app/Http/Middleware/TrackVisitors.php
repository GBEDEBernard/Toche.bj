<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Facades\Session;

class TrackVisitors
{
    public function handle(Request $request, Closure $next)
    {
        $sessionId = Session::getId();
        $ipAddress = $request->ip();

        // Vérifier si le visiteur est unique (par session ou IP)
        $visitor = Visitor::where('session_id', $sessionId)
                         ->whereDate('created_at', today())
                         ->first();

        if (!$visitor) {
            Visitor::create([
                'ip_address' => $ipAddress,
                'session_id' => $sessionId,
            ]);
        }

        return $next($request);
    }
}