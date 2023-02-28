<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    // on vérifie que l'utilisateur remplit les conditions souhaitées
    // on vérifie qu'il est bien administrateur
    public function handle(Request $request, Closure $next)
    {
        // si le user est connecté ET si il est admin
        if (Auth::user() && Auth::user()->role_id == "2") {
            return $next($request); // middleware passé => on continue
        }
        //sinon : on va renvoyer une erreur 403 ("forbidden")
        abort(403, 'Vous n\'êtes pas administrateur : accès refusé');
    }
}
