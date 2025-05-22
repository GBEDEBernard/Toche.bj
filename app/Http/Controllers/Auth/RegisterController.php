<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Ce contrôleur gère l'inscription des nouveaux utilisateurs ainsi que leur
    | validation et création. Par défaut, il utilise un trait pour fournir
    | cette fonctionnalité sans code additionnel.
    |
    */

    use RegistersUsers;

    /**
     * Où rediriger les utilisateurs après l'inscription.
     *
     * @var string
     */
    // Tu peux modifier cette constante si tu veux
    // protected $redirectTo = '/home';

    /**
     * Après l'inscription, redirige vers la page login (si c'est voulu).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function registered(Request $request, $user)
    {
        return redirect('/login');
    }

    /**
     * Créé une nouvelle instance du contrôleur.
     *
     * @return void
     */
    public function __construct()
    {
        // Seuls les invités peuvent accéder à l'inscription
        $this->middleware('guest');
    }

    /**
     * Valide les données reçues lors de l'inscription.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' vérifie la confirmation du mot de passe
        ]);
    }

    /**
     * Crée un nouvel utilisateur après une inscription validée.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
