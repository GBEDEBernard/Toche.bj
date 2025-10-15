<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    use RegistersUsers;

    // Redirection après inscription
    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
        // Limite à 10 inscriptions par minute par IP
        $this->middleware('throttle:10,1')->only('register');
    }

    // Validation des champs du formulaire
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8',                // minimum 8 caractères
                'confirmed',            // doit correspondre à password_confirmation
                'regex:/[a-z]/',        // au moins une minuscule
                'regex:/[A-Z]/',        // au moins une majuscule
                'regex:/[0-9]/',        // au moins un chiffre
                'regex:/[@$!%*#?&]/'    // au moins un caractère spécial
            ],
        ], [
            'password.regex' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.',
        ]);
    }

    // Création de l'utilisateur
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), // hashage sécurisé
        ]);

        // Attribuer le rôle 'user'
        $user->assignRole('user');

        // Envoyer email de vérification
        event(new Registered($user));

        return $user;
    }

    // Après inscription
    protected function registered(Request $request, $user)
    {
        // Redirection vers login avec message
        return redirect($this->redirectTo)->with('success', 'Inscription réussie ! Vérifiez votre email pour activer votre compte.');
    }
}
