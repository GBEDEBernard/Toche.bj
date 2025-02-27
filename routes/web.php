<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormulaireController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourismeController;
use App\Http\Controllers\Site_touristiqueController;
use App\Http\Controllers\AproposController;
use App\Http\Controllers\EvenementsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\AcceuilController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Routes publiques (accessibles sans authentification)
|--------------------------------------------------------------------------
*/
Route::get('/', [AcceuilController::class, 'index'])->name('accueil');
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/contact', [ContactController::class, 'contact'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'traitement_contact'])->name('contact.traitement');

Route::get('/tourisme', [TourismeController::class, 'index'])->name('tourisme.index');

/*
|--------------------------------------------------------------------------
| Authentification
|--------------------------------------------------------------------------
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| Routes protégées (nécessitent une connexion)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    
    // 🔹 Dashboard après connexion
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');

    // 🔹 Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // 🔹 Gestion des contacts
    Route::get('/liste-contacts', [ContactController::class, 'listeContacts'])->name('contact.liste');
    Route::get('/modifier/{id}', [ContactController::class, 'modifierContact'])->name('contact.modifier');
    Route::put('/modification-traitement/{id}', [ContactController::class, 'modificationContact'])->name('contact.modification');
    Route::delete('/supprimer/{id}', [ContactController::class, 'destroy'])->name('contact.supression');

    // 🔹 Formulaire
    Route::get('/formulaire', function () {
        return view('layouts.formulaire');
    })->name('formulaire');
    Route::post('/formulaire', [FormulaireController::class, 'submit'])->name('formulaire.submit');


     // Route pour la déconnexion
     Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    // Route::post('/login', [LoginController::class, 'login'])->name('login');

    /*
    |--------------------------------------------------------------------------
    | Routes supplémentaires protégées
    |--------------------------------------------------------------------------
    */

    Route::get('Site_touristique', [Site_touristiqueController::class, 'site'])->name('site_touristique');

    // 🔹 Routes pour les Apropos
    Route::get('apropos', [AproposController::class, 'index'])->name('apropos');

    Route::get('Evenements', [EvenementsController::class, 'index'])->name('evenements');


    // Route pour afficher la page de participation
    Route::get('participer', [ReservationsController::class, 'index'])->name('participer');
    
    Route::get('contacts', [ContactsController::class, 'index'])->name('Contacts');
    // 🔹 Accueil
    
});
