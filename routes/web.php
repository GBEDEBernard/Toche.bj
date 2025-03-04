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
use App\Http\Controllers\PayementController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\VisitesController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\AviController;
use App\Http\Controllers\GaleriesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\Controller;


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

Route::get('/formulaire', [FormulaireController::class, 'show'])->name('formulaire');

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
    Route::get('/dashboard', function () {
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
    

    /*Routes de Réservations*/

            Route::get('/Reservations', [ReservationsController::class, 'Reservation'])->name('Reservations');


    /*---------------------------------------
    | Routes de Paiements & Factures
    ----------------------------------------*/
    Route::get('/Payements', [PayementController::class, 'Payement'])->name('Payements');
    Route::get('/Factures', [PayementController::class, 'Facture'])->name('Factures');
    Route::get('/Confirmations', [PayementController::class, 'Confirmation'])->name('Confirmation');

   /*---------------------------------------
    | Routes pour les Sites Touristiques
    ----------------------------------------*/
  
        Route::get('Admin/Site_touristique/create', [Site_touristiqueController::class, 'create'])->name('create');
        Route::post('Admin/Site_touristique/create', [Site_touristiqueController::class, 'traitement_create_sites'])->name('sites.traitement');
        Route::get('Admin/Site_touristique/index', [Site_touristiqueController::class, 'Site_touristiques'])->name('index');
        Route::get('modification/editSite/{id}', [Site_touristiqueController::class, 'modifiersites'])->name('site.modifier');
        Route::put('modification/editSite/{id}', [Site_touristiqueController::class, 'modificationsites'])->name('Site.modification');
        Route::delete('Admin/Site_touristique/delete/{id}', [Site_touristiqueController::class, 'Suprimer'])->name('Site.supression');
    
    /*---------------------------------------
    | Routes pour les Catégories
    ----------------------------------------*/
        Route::get('Admin/Categories/createcategorie', [CategorieController::class, 'createcategorie'])->name('createcategorie');
        Route::post('Admin/Categories/createcategorie', [CategorieController::class, 'traitement_createcategorie'])->name('categorie.traitement');
        Route::get('Admin/Categories/indexcategorie', [CategorieController::class, 'Categorie'])->name('indexcategorie');
        Route::get('modification/editCategorie/{id}', [CategorieController::class, 'modifiercategorie'])->name('categorie.modifier');
        Route::put('modification/editCategorie/{id}', [CategorieController::class, 'modificationcategorie'])->name('categorie.modification');
        Route::delete('Admin/Categories/delete/{id}', [CategorieController::class, 'Supression'])->name('categorie.supression');
    
    /*---------------------------------------
    | Routes pour les Événements
    ----------------------------------------*/
   
        Route::get('Admin/Evenements/create', [EvenementsController::class, 'create_evenement'])->name('evenement.create');
        Route::post('Admin/Evenements/create', [EvenementsController::class, 'traitement_create_evenement'])->name('evenements.traitement');
        Route::get('Admin/Evenements/index', [EvenementsController::class, 'Evenement'])->name('indexevenements');
        Route::get('modification/editevenement/{id}', [EvenementsController::class, 'modifierevenements'])->name('evenements.modifier');
        Route::put('modification/editevenement/{id}', [EvenementsController::class, 'modificationevenements'])->name('evenements.modification');
        Route::delete('Admin/Evenements/delete/{id}', [EvenementsController::class, 'Supressionevenements'])->name('evenements.supression');

    /*---------------------------------------
    | Routes pour les Visites
    ----------------------------------------*/
   
        Route::get('Admin/Visites/create', [VisitesController::class, 'create_visite'])->name('visites');
        Route::post('Admin/Visites/create', [VisitesController::class, 'traitement_create_visite'])->name('visites.traitement');
        Route::get('Admin/Visites/index', [VisitesController::class, 'visite'])->name('indexvisites');
        Route::get('modification/editvisite/{id}', [VisitesController::class, 'modifiervisite'])->name('visites.modifier');
        Route::put('modification/editvisite/{id}', [VisitesController::class, 'modificationvisite'])->name('visites.modification');
        Route::delete('Admin/Visites/delete/{id}', [VisitesController::class, 'Supressionvisite'])->name('visites.supression');
    
    /*---------------------------------------
    | Routes pour les Réservations
    ----------------------------------------*/
   
        Route::get('Admin/Reservations/create', [ReservationsController::class, 'create_reservation'])->name('reservations');
        Route::post('/create', [ReservationsController::class, 'traitement_create_reservation'])->name('reservations.traitement');
        Route::get('Admin/Reservations/index', [ReservationsController::class, 'reservations'])->name('indexreservations');
        Route::get('modification/editreservation/{id}', [ReservationsController::class, 'modifierreservation'])->name('reservations.modifier');
        Route::put('modification/editreservation/{id}', [ReservationsController::class, 'modificationreservation'])->name('reservations.modification');
        Route::delete('Admin/Reservations/delete/{id}', [ReservationsController::class, 'Supressionreservation'])->name('reservations.supression');
    
    /*---------------------------------------
    | Routes pour les Tickets
    ----------------------------------------*/
        Route::get('Admin/Tickets/create', [TicketsController::class, 'create_ticket'])->name('tickets');
        Route::post('Admin/Tickets/create', [TicketsController::class, 'traitement_create_ticket'])->name('tickets.traitement');
        Route::get('Admin/Tickets/index', [TicketsController::class, 'ticket'])->name('indextickets');
        Route::get('Admin/Tickets/update/{id}', [TicketsController::class, 'modifierticket'])->name('tickets.modifier');
        Route::put('Admin/Tickets/update/{id}', [TicketsController::class, 'modificationticket'])->name('tickets.modification');
        Route::delete('Admin/Tickets/delete/{id}', [TicketsController::class, 'Supressionticket'])->name('tickets.supression');
  
    /*---------------------------------------
    | Routes pour les Avis
    ----------------------------------------*/
        Route::get('Admin/Avis/create', [AviController::class, 'create_avis'])->name('avis');
        Route::post('Admin/Avis/create', [AviController::class, 'traitement_create_avis'])->name('avis.traitement');
        Route::get('Admin/Avis/index', [AviController::class, 'avis'])->name('indexavis');
        Route::get('Admin/Avis/update/{id}', [AviController::class, 'modifieravis'])->name('avis.modifier');
        Route::put('/update/{id}', [AviController::class, 'modificationavis'])->name('avis.modification');
        Route::delete('Admin/Avis/delete/{id}', [AviController::class, 'Supressionavis'])->name('avis.supression');
    
    /*---------------------------------------
    | Routes pour les Utilisateurs (Users)
       ----------------------------------------*/
        Route::get('Admin/Users/create', [Controller::class, 'create_users'])->name('users');
        Route::post('Admin/Users/create', [Controller::class, 'traitement_create_users'])->name('users.traitement');
        Route::get('Admin/Users/index', [Controller::class, 'users'])->name('indexusers');
        Route::get('Admin/Users/update/{id}', [Controller::class, 'modifierusers'])->name('users.modifier');
        Route::put('Admin/Users/update/{id}', [Controller::class, 'modificationusers'])->name('users.modification');
        Route::delete('Admin/Users/delete/{id}', [Controller::class, 'Supressionusers'])->name('users.supression');

    /*---------------------------------------
    | Routes pour les Rôles
    ----------------------------------------*/
   
        Route::get('Admin/Roles/create', [RolesController::class, 'create_roles'])->name('roles');
        Route::post('Admin/Roles/create', [RolesController::class, 'traitement_create_roles'])->name('roles.traitement');
        Route::get('Admin/Roles/index', [RolesController::class, 'roles'])->name('indexroles');
        Route::get('Role/editRoles/{id}', [RolesController::class, 'modifierroles'])->name('roles.modifier');
        Route::put('Role/editRoles/{id}', [RolesController::class, 'modificationroles'])->name('roles.modification');
        Route::delete('Admin/Roles/delete/{id}', [RolesController::class, 'Supressionroles'])->name('roles.supression');
    
    /*---------------------------------------
    | Routes pour les Galeries
    ----------------------------------------*/
   
        Route::get('Admin/Galeries/create', [GaleriesController::class, 'photo'])->name('photos');
        Route::post('Admin/Galeries/create', [GaleriesController::class, 'store'])->name('Galeries.traitement');
        Route::post('Admin/Galeries/index', [GaleriesController::class, 'store'])->name('stores');
        Route::get('Admin/Galeries/show', [GaleriesController::class, 'show'])->name('shows');
});
