<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // <-- Ajout de cette ligne

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Ce contrôleur gère l'authentification des utilisateurs et leur redirection
    | après la connexion.
    |
    */

    use AuthenticatesUsers;

    /**
     * Où rediriger les utilisateurs après une connexion réussie.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */

    /**
     * Rediriger après une connexion réussie.
     */
    protected function authenticated(Request $request, $user)
    {
         // Rediriger l'utilisateur vers la page AdminLTE après la connexion
         if ($user->can('access.welcome')) {
            return redirect()->to('/welcome');
        } else {
            return redirect()->to('/accueil');
        }    }

    /**
     * Créer une nouvelle instance de contrôleur.
     *
     * @return void
     */
    public function __construct()
    {
        // On protège l'accès à la page de connexion pour les utilisateurs déjà connectés
        $this->middleware('guest')->except('logout'); // On laisse la méthode logout accessible même pour les utilisateurs connectés
    }
}
