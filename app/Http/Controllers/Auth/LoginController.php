<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Par défaut, redirige vers la page d'accueil
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Si l'utilisateur est admin (user_id = 1 ou rôle admin)
        if ($user->id === 1 || $user->hasRole('admin')) {
            return redirect()->intended('/welcome'); // Redirige vers /admin ou page demandée
        }

        // Pour les utilisateurs standards, redirige vers la page demandée ou /
        return redirect()->intended($this->redirectTo);
    }
}