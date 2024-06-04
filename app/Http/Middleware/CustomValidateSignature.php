<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class CustomValidateSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        dd($request);
        // Vérifiez si la signature est valide
        if (! URL::hasValidSignature($request)) {
            // Déconnexion de l'utilisateur
            $user = Auth::guard($guard)->user();
            Auth::guard($guard)->logout();
            // Envoyer un nouvel e-mail de vérification
            if ($user) {
                event(new Registered($user));
            }
            // Rediriger vers la page de login
            return redirect()->route('login')->with('warning', 'El enlace de verificación no es válido o ha caducado. Se ha enviado un nuevo correo electrónico de verificación.');
        }

        return $next($request);
    }

}
