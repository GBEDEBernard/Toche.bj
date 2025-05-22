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
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\VisitesController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\AviController;
use App\Http\Controllers\GaleriesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Routes publiques (accessibles sans authentification)
|--------------------------------------------------------------------------
*/
Route::get('/',[AcceuilController::class, 'index'])->name('accueil');
Route::get('/welcome', [Controller::class, 'welcome'])->middleware(['auth', 'can:access.welcome'])->name('welcome');
// Routes d'authentification (générées automatiquement par Auth::routes())
Auth::routes();

Route::get('/contact', [ContactController::class, 'contact'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'traitement_contact'])->name('contact.traitement');

Route::get('/tourisme', [TourismeController::class, 'index'])->name('tourisme.index');

Route::get('/formulaire', [FormulaireController::class, 'show'])->name('formulaire');

// 🔹 Profil utilisateur
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// 🔹 Gestion des contacts (admin only)
Route::middleware(['auth', 'can:contacts.index'])->group(function () {
    Route::get('/liste-contacts', [ContactController::class, 'listeContacts'])->name('contact.liste');
    Route::get('/modifier/{id}', [ContactController::class, 'modifierContact'])->name('contact.modifier')->middleware('can:contacts.edit');
    Route::put('/modification-traitement/{id}', [ContactController::class, 'modificationContact'])->name('contact.modification')->middleware('can:contacts.update');
    Route::delete('/supprimer/{id}', [ContactController::class, 'destroy'])->name('contact.supression')->middleware('can:contacts.delete');
});

// 🔹 Formulaire
Route::get('/formulaire', function () {
    return view('layouts.formulaire');
})->name('formulaire');
Route::post('/formulaire', [FormulaireController::class, 'submit'])->name('formulaire.submit');

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

/*Routes de Réservations*/
Route::get('/Reservations', [ReservationsController::class, 'Reservation'])->name('Reservations');

/*---------------------------------------
| Routes de Paiements & Factures
----------------------------------------*/
Route::middleware(['auth'])->group(function () {
    Route::get('/Payements', [PayementController::class, 'Payement'])->name('Payements');
    Route::get('/Factures', [PayementController::class, 'Facture'])->name('Factures');
    Route::get('/Confirmations', [PayementController::class, 'Confirmation'])->name('Confirmation');
});

/*---------------------------------------
| Routes pour les Sites Touristiques (Admin only)
----------------------------------------*/
Route::middleware(['auth', 'can:sti_touristique.index'])->prefix('Admin')->group(function () {
    Route::get('Site_touristique/create', [Site_touristiqueController::class, 'create'])->name('create')->middleware('can:sti_touristique.create');
    Route::post('Site_touristique/create', [Site_touristiqueController::class, 'traitement_create_sites'])->name('sites.traitement');
    Route::get('Site_touristique/index', [Site_touristiqueController::class, 'Site_touristiques'])->name('index');

    Route::get('/editsite/{id}', [Site_touristiqueController::class, 'modifiersites'])->name('site.modifier')->middleware('can:sti_touristique.edit');
    Route::put('/editsite/{id}', [Site_touristiqueController::class, 'modificationsites'])->name('Site.modification')->middleware('can:sti_touristique.update');
  
    // Route::get('Admin/modification/editSite/{id}', [Site_touristiqueController::class, 'modifiersites'])->name('site.modifier')->middleware('can:sti_touristique.edit');
    // Route::put('Admin/modification/editSite/{id}', [Site_touristiqueController::class, 'modificationsites'])->name('Site.modification')->middleware('can:sti_touristique.update');
   
    Route::delete('Site_touristique/delete/{id}', [Site_touristiqueController::class, 'Suprimer'])->name('Site.supression')->middleware('can:sti_touristique.delete');
});

Route::get('/sites/{site}', [Site_touristiqueController::class, 'show'])->name('sites.show');

/*---------------------------------------
| Routes pour les Catégories (Admin only)
----------------------------------------*/
Route::middleware(['auth', 'can:categories.index'])->prefix('Admin')->group(function () {
    Route::get('Categories/createcategorie', [CategorieController::class, 'createcategorie'])->name('createcategorie')->middleware('can:categories.create');
    Route::post('Categories/createcategorie', [CategorieController::class, 'traitement_createcategorie'])->name('categorie.traitement');
    Route::get('Categories/indexcategorie', [CategorieController::class, 'Categorie'])->name('indexcategorie');
    Route::get('/editcategorie/{id}', [CategorieController::class, 'modifiercategorie'])->name('categorie.modifier')->middleware('can:categories.edit');
    Route::put('/editcategorie/{id}', [CategorieController::class, 'modificationcategorie'])->name('categorie.modification')->middleware('can:categories.update'); 
    Route::delete('Categories/delete/{id}', [CategorieController::class, 'Supression'])->name('categorie.supression')->middleware('can:categories.delete');
});

/*---------------------------------------
| Routes pour les Événements
----------------------------------------*/
Route::middleware(['auth', 'can:evenements.index'])->prefix('Admin')->group(function () {
    Route::get('Evenements/create', [EvenementsController::class, 'create_evenement'])->name('evenement.create')->middleware('can:evenements.create');
    Route::post('Evenements/create', [EvenementsController::class, 'traitement_create_evenement'])->name('evenements.traitement');
    Route::get('Evenements/index', [EvenementsController::class, 'Evenement'])->name('indexevenements');
    Route::get('/editevenement/{id}', [EvenementsController::class, 'modifierevenements'])->name('evenements.modifier')->middleware('can:evenements.edit');
    Route::put('/editevenement/{id}', [EvenementsController::class, 'modificationevenements'])->name('evenements.modification')->middleware('can:evenements.update');
    Route::delete('Evenements/delete/{id}', [EvenementsController::class, 'Supressionevenements'])->name('evenements.supression')->middleware('can:evenements.delete');
});

// Public show route for events
Route::get('/admin/evenements/{id}', [EvenementsController::class, 'show'])->name('admin.evenements.show');

/*---------------------------------------
| Routes pour les Visites
----------------------------------------*/
Route::middleware(['auth', 'can:visites.index'])->prefix('Admin')->group(function () {
    Route::get('Visites/create', [VisitesController::class, 'create_visite'])->name('visites')->middleware('can:visites.create');
    Route::post('Visites/create', [VisitesController::class, 'traitement_create_visite'])->name('visites.traitement');
    Route::get('Visites/index', [VisitesController::class, 'visite'])->name('indexvisites');
    Route::get('/editvisite/{id}', [VisitesController::class, 'modifiervisite'])->name('visites.modifier')->middleware('can:visites.edit');
    Route::put('/editvisite/{id}', [VisitesController::class, 'modificationvisite'])->name('visites.modification')->middleware('can:visites.update');
    Route::delete('Visites/delete/{id}', [VisitesController::class, 'destroy'])->name('visites.supression')->middleware('can:visites.delete');
});

/*---------------------------------------
| Routes pour les Réservations
----------------------------------------*/
Route::middleware(['auth'])->group(function () {
    Route::get('Admin/Reservations/create', [ReservationsController::class, 'create_reservation'])->name('reservations')->middleware('can:reservations.create');
    Route::post('/create', [ReservationsController::class, 'traitement_create_reservation'])->name('reservations.traitement');
    Route::get('Admin/Reservations/index', [ReservationsController::class, 'reservations'])->name('indexreservations')->middleware('can:reservations.index');
    Route::get('Admin/editreservation/{id}', [ReservationsController::class, 'modifierreservation'])->name('reservations.modifier')->middleware('can:reservations.edit');
    Route::put('Admin/editreservation/{id}', [ReservationsController::class, 'modificationreservation'])->name('reservations.modification')->middleware('can:reservations.update');
    Route::delete('/Admin/Reservations/delete/{id}', [ReservationsController::class, 'destroy'])->name('reservations.destroy')->middleware('can:reservations.delete');
});

/*---------------------------------------
| Routes pour les Tickets
----------------------------------------*/
Route::middleware(['auth', 'can:tickets.index'])->prefix('Admin')->group(function () {
    Route::get('Tickets/create', [TicketsController::class, 'create_ticket'])->name('tickets')->middleware('can:tickets.create');
    Route::post('Tickets/create', [TicketsController::class, 'traitement_create_ticket'])->name('tickets.traitement');
    Route::get('Tickets/index', [TicketsController::class, 'ticket'])->name('indextickets');
    

    Route::get('/editticket/{id}', [TicketsController::class, 'modifierticket'])->name('tickets.modifier')->middleware('can:tickets.edit');
    Route::put('/editticket/{id}', [TicketsController::class, 'modificationticket'])->name('tickets.modification')->middleware('can:tickets.update');
   
    Route::delete('Tickets/delete/{id}', [TicketsController::class, 'Supressionticket'])->name('tickets.supression')->middleware('can:tickets.delete');
});

/*---------------------------------------
| Routes pour les Avis
----------------------------------------*/
Route::middleware(['auth', 'can:avis.index'])->prefix('Admin')->group(function () {
    Route::get('Avis/create', [AviController::class, 'create_avis'])->name('avis')->middleware('can:avis.create');
    Route::post('Avis/create', [AviController::class, 'traitement_create_avis'])->name('avis.traitement');
    Route::get('Avis/index', [AviController::class, 'avis'])->name('indexavis');
    Route::get('Admin/Avis/update/{id}', [AviController::class, 'modifieravis'])->name('avis.modifier')->middleware('can:avis.edit');
    Route::put('/update/{id}', [AviController::class, 'modificationavis'])->name('avis.modification')->middleware('can:avis.update');
    Route::delete('Avis/delete/{id}', [AviController::class, 'Supressionavis'])->name('avis.supression')->middleware('can:avis.delete');
});

/*---------------------------------------
| Routes pour les Utilisateurs (Users) - Admin only
----------------------------------------*/
Route::middleware(['auth'])->prefix('Admin')->group(function () {
    Route::get('Users/create', [UserController::class, 'create_users'])->name('users');
    Route::post('Users/create', [UserController::class, 'traitement_create_users'])->name('users.traitement');
    Route::get('Users/index', [UserController::class, 'users'])->name('indexusers');
    Route::get('/ediuser/{id}', [UserController::class, 'modifierusers'])->name('users.modifier');
    Route::put('/editusers/{id}', [UserController::class, 'modificationusers'])->name('users.modification');

    Route::delete('Users/delete/{id}', [UserController::class, 'Supressionusers'])->name('users.supression');
});

/*---------------------------------------
| Routes pour les Rôles - Admin only
----------------------------------------*/
Route::middleware(['auth', 'can:roles.index'])->prefix('Admin')->group(function () {
    Route::get('Roles/create', [RolesController::class, 'create_roles'])->name('roles')->middleware('can:roles.create');
    Route::post('Roles/create', [RolesController::class, 'traitement_create_roles'])->name('roles.traitement');
    Route::get('Roles/index', [RolesController::class, 'roles'])->name('indexroles');
    Route::get('Role/editRoles/{id}', [RolesController::class, 'modifierroles'])->name('roles.modifier')->middleware('can:roles.edit');
    Route::put('Role/editRoles/{id}', [RolesController::class, 'modificationroles'])->name('roles.modification')->middleware('can:roles.update');
    Route::delete('Roles/delete/{id}', [RolesController::class, 'Supressionroles'])->name('roles.supression')->middleware('can:roles.delete');
});

/*---------------------------------------
| Routes pour les Galeries
----------------------------------------*/
Route::middleware(['auth', 'can:galeries.index'])->prefix('Admin')->group(function () {
    Route::get('Galeries/create', [GaleriesController::class, 'photo'])->name('photos')->middleware('can:galeries.create');
    Route::post('Galeries/create', [GaleriesController::class, 'store'])->name('Galeries.traitement');
    Route::get('Galeries/index', [GaleriesController::class, 'index'])->name('galeries.index');
    Route::get('editgalerie/{id}', [GaleriesController::class, 'edit'])->name('galerie.modifier')->middleware('can:galeries.edit');
    Route::put('editgalerie/{id}', [GaleriesController::class, 'update'])->name('galerie.update')->middleware('can:galeries.update');
    Route::delete('Galerie/delete/{id}', [GaleriesController::class, 'Supressiongalerie'])->name('galerie.supression')->middleware('can:galeries.delete');
});