<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Partie;
use App\Models\Joue;

class JouePartieMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $codePartie = $request->segment(count($request->segments()));
        $user = auth()->user();
        $idPartie = Partie::verifyCode($codePartie);
        $estParticipant = Joue::estParticipant($idPartie, $user->id);
        if (!$estParticipant) {
            return redirect()->route('rejoindrePartie')->withErrors(['error' => 'Vous n\'êtes pas autorisé à accéder à cette partie.']);
        }
        return $next($request);
    }
}
