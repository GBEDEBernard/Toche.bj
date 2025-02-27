<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * @var string
     */
    protected $redirectTo = '/welcome'; // Rediriger vers /home ou la page souhaitée

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
