<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Logout the user and redirect to the homepage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();  // Déconnecter l'utilisateur
        
        $request->session()->invalidate();  // Invalider la session
        $request->session()->regenerateToken();  // Régénérer le token CSRF

        return redirect()->route('accueil');  // Rediriger vers la page d'accueil
    }
}
