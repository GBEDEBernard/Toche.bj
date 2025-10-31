<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    FormulaireController, ContactController, ProfileController, TourismeController,
    Site_touristiqueController, EvenementsController, ReservationsController,
    ContactsController, AcceuilController, LogoutController, LoginController,
    RegisterController, PayementController, CategorieController, VisitesController,
    TicketsController, AviController, GaleriesController, RoleController, UserController,
    Controller, PaiementController, PieceIdentiteController, CommentaireController,
    AvisController, SiteDetailController, EvenementParagrapheController, SearchController,
    AproposController, NewsletterController, FaqController, HotelController,MessageController,
    NotificationController,AgenceVoyageController,ItineraireController,ItineraireSiteController
};
use App\Http\Controllers\DemandeParticipationController;


/*
|--------------------------------------------------------------------------
| Routes Publiques
| Accessible à tous, avec permission 'access_public' pour les pages générales
| et permissions spécifiques pour certaines actions
|--------------------------------------------------------------------------
*/
// Routes publiques
Route::get('/contact', [ContactController::class, 'contact'])->name('contact.liste');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Mot de passe
    Route::get('/profile/password/edit', [ProfileController::class, 'editPassword'])->name('profile.password.edit');
    Route::post('/profile/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Suppression compte
    Route::get('/profile/delete/confirm', [ProfileController::class, 'confirmDelete'])->name('profile.delete.confirm');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route pour recherche
Route::get('/admin/search', [SearchController::class, 'search'])->name('admin.search');
// Page d'accueil
Route::get('/', [AcceuilController::class, 'index'])->name('accueil');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store')->middleware('can:newsletter.subscribe');
// Contact
Route::middleware(['auth'])->group(function () {
    Route::get('/Contacts', [ContactController::class, 'index'])->name('Contacts');
    Route::post('/contact', [ContactController::class, 'traitement_contact'])->name('contact.traitement');
});

// Tourisme
Route::get('/tourisme', [TourismeController::class, 'index'])->name('tourisme.index')->middleware('auth');
// Formulaire

Route::middleware(['auth'])->group(function () {
Route::get('/formulaire', [FormulaireController::class, 'show'])->name('formulaire')->middleware('auth');
});
// Sites touristiques
    Route::get('Site_touristique', [Site_touristiqueController::class, 'site'])->name('site_touristique');
    Route::get('/sites/{site}', [Site_touristiqueController::class, 'show'])->name('sites.show');

// Événements
 Route::get('Evenements', [EvenementsController::class, 'index'])->name('evenements');
 
 Route::middleware(['auth'])->group(function () {
    Route::get('participer', fn() => redirect()->route('evenements'))->name('participer');
});

// À Propos
    Route::get('/apropos', [AproposController::class, 'index'])->name('apropos');

   Route::middleware(['auth'])->group(function () {
    Route::get('/editapropos/{apropos}/edit', [AproposController::class, 'edit'])->name('apropos.edit')->middleware('can:apropos.edit');
});

// Tickets
Route::middleware(['auth'])->group(function () {
    Route::get('/tickets/availability/{ticket_id}', [ReservationsController::class, 'getTicketAvailability'])->name('tickets.availability');
    Route::get('/tickets/by-evenement/{evenement_id}', [ReservationsController::class, 'getTicketsByEvenement'])->name('tickets.by-evenement');
});

// Page de remerciement
Route::get('Public/Reservations/merci', function () {
    return view('Public.Reservation.merci');
})->name('merci.reservation')->middleware(['auth', 'can:reservations.show']);

/*
|--------------------------------------------------------------------------
| Routes d'Authentification
| Gérées par Laravel Auth     'can:access.welcome'
|--------------------------------------------------------------------------
*/
Auth::routes();
Route::get('/welcome', [Controller::class, 'welcome'])->middleware(['auth'])->name('welcome');

/*
|--------------------------------------------------------------------------
| Routes Protégées par Authentification
| Nécessitent un utilisateur connecté, avec permissions spécifiques
|--------------------------------------------------------------------------
*/

// Profil utilisateur
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('can:profil.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('can:profil.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('can:profil.edit');
});

// Commentaires
Route::post('/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store')->middleware(['auth', 'can:commentaires.create']);

// Avis publics
Route::middleware(['auth'])->group(function () {
    Route::post('/avis', [AvisController::class, 'store'])->name('avis.store')->middleware('can:avis.create');
    Route::post('/avis/{id}/repondre', [AvisController::class, 'repondre'])->name('avis.repondre')->middleware('can:avis.create');
    Route::put('/avis/{avis}', [AvisController::class, 'update'])->name('avis.update')->middleware('can:avis.edit');
});

// Réservations publiques
Route::middleware(['auth'])->group(function () {
    Route::get('/reservations/create/{evenement_id}', [ReservationsController::class, 'showReservationForm'])->name('public.reservations.create')->middleware('can:reservations.create');
    Route::post('/reservations/store', [ReservationsController::class, 'store'])->name('public.reservations.store')->middleware('can:reservations.create');
});

// Paiements publics
Route::middleware(['auth'])->group(function () {
    Route::get('/paiement/mobile/{id}', [PaiementController::class, 'formMobileMoney'])->name('paiement.mobile')->middleware('can:paiement.create');
    Route::post('/paiement/mobile/{id}', [PaiementController::class, 'processMobileMoney'])->name('paiement.mobile.process')->middleware('can:paiement.create');
    Route::get('/paiement/banque/{id}', [PaiementController::class, 'formBanque'])->name('paiement.banque')->middleware('can:paiement.create');
    Route::post('/paiement/banque/{id}', [PaiementController::class, 'processBanque'])->name('paiement.banque.process')->middleware('can:paiement.create');
    Route::get('/paiement/banque/{reservation}', [PaiementController::class, 'formBanque'])->name('paiements.banque.form')->middleware('can:paiement.create');
    Route::post('/paiement/banque', [PaiementController::class, 'storeBanque'])->name('paiements.banque.store')->middleware('can:paiement.create');
});

// Paiements et factures
Route::middleware(['auth'])->group(function () {
    Route::get('/Payements', [PayementController::class, 'Payement'])->name('Payements')->middleware('can:paiement.show');
    Route::get('/Factures', [PayementController::class, 'Facture'])->name('Factures')->middleware('can:paiement.show');
    Route::get('/Confirmations', [PayementController::class, 'Confirmation'])->name('Confirmation')->middleware('can:paiement.show');
});

// Contacts admin
Route::middleware(['auth', 'can:contacts.index'])->group(function () {
    Route::get('/liste-contacts', [ContactController::class, 'listeContacts'])->name('contact.liste');
    Route::get('/modifier/{id}', [ContactController::class, 'modifierContact'])->name('contact.modifier')->middleware('can:contacts.edit');
    Route::put('/modification-traitement/{id}', [ContactController::class, 'modificationContact'])->name('contact.modification')->middleware('can:contacts.edit');
    Route::delete('/supprimer/{id}', [ContactController::class, 'destroy'])->name('contact.supression')->middleware('can:contacts.delete');
});

/*
|--------------------------------------------------------------------------
| Routes Admin
| Protégées par authentification et permissions spécifiques
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth' , 'check.session'])->group(function () {
    // Recherche
    Route::get('/search', [SearchController::class, 'index'])->name('admin.search')->middleware('can:access_admin');

    // À Propos
    Route::prefix('apropos')->name('admin.apropos.')->middleware('can:apropos.index')->group(function () {
        Route::get('/', [AproposController::class, 'indexAdmin'])->name('index');
        Route::get('/create', [AproposController::class, 'create'])->name('create')->middleware('can:apropos.create');
        Route::post('/', [AproposController::class, 'store'])->name('store')->middleware('can:apropos.create');
        Route::put('/{apropos}', [AproposController::class, 'update'])->name('update')->middleware('can:apropos.edit');
        Route::delete('/{apropos}', [AproposController::class, 'destroy'])->name('destroy')->middleware('can:apropos.delete');
        Route::get('/{apropos}/edit', [AproposController::class, 'edit'])->name('edit')->middleware('can:apropos.edit');
    });

    Route::prefix('newsletters')->name('admin.newsletters.')->middleware('can:newsletters.index')->group(function () {
    Route::get('/index', [NewsletterController::class, 'index'])->name('index');
    Route::get('/create', [NewsletterController::class, 'create'])->name('create')->middleware('can:newsletters.create');
    Route::post('/', [NewsletterController::class, 'store'])->name('store')->middleware('can:newsletters.create');
    Route::get('/{id}/edit', [NewsletterController::class, 'edit'])->name('edit')->middleware('can:newsletters.edit');
    Route::put('/{id}', [NewsletterController::class, 'update'])->name('update')->middleware('can:newsletters.edit');
    Route::delete('/{id}', [NewsletterController::class, 'destroy'])->name('destroy')->middleware('can:newsletters.delete');
});

// Route publique
Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.store');

    // FAQ
    Route::resource('faqs', FaqController::class)->names('admin.faqs')->middleware('can:faqs.index');
    Route::get('/editfaqs/{faqs}', [FaqController::class, 'update'])->name('editfaqs')->middleware('can:faqs.edit');

    // Hôtels
    Route::prefix('hotels')->name('admin.hotels.')->middleware('can:hotels.index')->group(function () {
        Route::get('/', [HotelController::class, 'index'])->name('index');
        Route::get('/create', [HotelController::class, 'create'])->name('create')->middleware('can:hotels.create');
        Route::post('/store', [HotelController::class, 'store'])->name('store')->middleware('can:hotels.create');
        Route::get('/{hotel}/edit', [HotelController::class, 'edit'])->name('edit')->middleware('can:hotels.edit');
        Route::put('/{hotel}', [HotelController::class, 'update'])->name('update')->middleware('can:hotels.edit');
        Route::delete('/{hotel}', [HotelController::class, 'destroy'])->name('destroy')->middleware('can:hotels.delete');
    });

    // Sites Touristiques
    Route::prefix('Site_touristique')->middleware(['can:sti_touristique.index'])->group(function () {
        Route::get('/create', [Site_touristiqueController::class, 'create'])->name('create')->middleware('can:sti_touristique.create');
        Route::post('/create', [Site_touristiqueController::class, 'traitement_create_sites'])->name('sites.traitement');
        Route::get('/index', [Site_touristiqueController::class, 'Site_touristiques'])->name('index');
        Route::get('/editsite/{id}', [Site_touristiqueController::class, 'modifiersites'])->name('site.modifier')->middleware('can:sti_touristique.edit');
        Route::put('/editsite/{id}', [Site_touristiqueController::class, 'modificationsites'])->name('Site.modification')->middleware('can:sti_touristique.edit');
        Route::delete('/delete/{id}', [Site_touristiqueController::class, 'Suprimer'])->name('Site.supression')->middleware('can:sti_touristique.delete');
    });

    // Détails des sites
    Route::prefix('details')->name('admin.details.')->middleware('can:details.index')->group(function () {
        Route::get('/', [SiteDetailController::class, 'index'])->name('index');
        Route::get('/create', [SiteDetailController::class, 'create'])->name('create')->middleware('can:details.create');
        Route::post('/store', [SiteDetailController::class, 'store'])->name('store')->middleware('can:details.create');
        Route::get('/{detail}', [SiteDetailController::class, 'show'])->name('show')->middleware('can:details.show');
        Route::get('/{detail}/edit', [SiteDetailController::class, 'edit'])->name('edit')->middleware('can:details.edit');
        Route::put('/{detail}', [SiteDetailController::class, 'update'])->name('update')->middleware('can:details.edit');
        Route::delete('/{detail}', [SiteDetailController::class, 'destroy'])->name('destroy')->middleware('can:details.delete');
    });

    // Catégories
    Route::prefix('Categories')->middleware(['can:categories.index'])->group(function () {
        Route::get('/createcategorie', [CategorieController::class, 'createcategorie'])->name('createcategorie')->middleware('can:categories.create');
        Route::post('/createcategorie', [CategorieController::class, 'traitement_createcategorie'])->name('categorie.traitement');
        Route::get('/indexcategorie', [CategorieController::class, 'Categorie'])->name('indexcategorie');
        Route::get('/editcategorie/{id}', [CategorieController::class, 'modifiercategorie'])->name('categorie.modifier')->middleware('can:categories.edit');
        Route::put('/editcategorie/{id}', [CategorieController::class, 'modificationcategorie'])->name('categorie.modification')->middleware('can:categories.edit');
        Route::delete('/delete/{id}', [CategorieController::class, 'supression'])->name('categorie.supression')->middleware('can:categories.delete');
    });

    // Événements
    Route::prefix('Evenements')->middleware(['can:evenements.index'])->group(function () {
        Route::get('/create', [EvenementsController::class, 'create_evenement'])->name('evenement.create')->middleware('can:evenements.create');
        Route::post('/create', [EvenementsController::class, 'traitement_create_evenement'])->name('evenements.traitement');
        Route::get('/index', [EvenementsController::class, 'Evenement'])->name('indexevenements');
        Route::get('/editevenement/{id}', [EvenementsController::class, 'modifierevenements'])->name('evenements.modifier')->middleware('can:evenements.edit');
        Route::put('/editevenement/{id}', [EvenementsController::class, 'modificationevenements'])->name('evenements.modification')->middleware('can:evenements.edit');
        Route::delete('/delete/{id}', [EvenementsController::class, 'Supressionevenements'])->name('evenements.supression')->middleware('can:evenements.delete');
    });

    Route::get('/evenements/{id}', [EvenementsController::class, 'show'])->name('admin.evenements.show')->middleware('can:evenements.show');

    // Paragraphes d'événements
    Route::prefix('paragraphes')->name('admin.paragraphes.')->middleware('can:paragraphes.index')->group(function () {
        Route::get('/', [EvenementParagrapheController::class, 'index'])->name('index');
        Route::get('/create', [EvenementParagrapheController::class, 'create'])->name('create')->middleware('can:paragraphes.create');
        Route::post('/store', [EvenementParagrapheController::class, 'store'])->name('store')->middleware('can:paragraphes.create');
        Route::get('/{paragraphe}', [EvenementParagrapheController::class, 'show'])->name('show')->middleware('can:paragraphes.show');
        Route::get('/{paragraphe}/edit', [EvenementParagrapheController::class, 'edit'])->name('edit')->middleware('can:paragraphes.edit');
        Route::put('/{paragraphe}', [EvenementParagrapheController::class, 'update'])->name('update')->middleware('can:paragraphes.edit');
        Route::delete('/{paragraphe}', [EvenementParagrapheController::class, 'destroy'])->name('destroy')->middleware('can:paragraphes.delete');
    });

    // Visites
    Route::prefix('Visites')->middleware(['can:visites.index'])->group(function () {
        Route::get('/create', [VisitesController::class, 'create_visite'])->name('visites')->middleware('can:visites.create');
        Route::post('/create', [VisitesController::class, 'traitement_create_visite'])->name('visites.traitement');
        Route::get('/index', [VisitesController::class, 'visite'])->name('indexvisites');
        Route::get('/editvisite/{id}', [VisitesController::class, 'modifiervisite'])->name('visites.modifier')->middleware('can:visites.edit');
        Route::put('/editvisite/{id}', [VisitesController::class, 'modificationvisite'])->name('visites.modification')->middleware('can:visites.edit');
        Route::delete('/delete/{id}', [VisitesController::class, 'destroy'])->name('visites.supression')->middleware('can:visites.delete');
        Route::post('/visite/demande/{site}', [VisitesController::class, 'storeDemande'])->name('visite.demande.store');
    });

    // Réservations
    Route::prefix('Reservations')->middleware(['can:reservations.index'])->group(function () {
        Route::get('/index', [ReservationsController::class, 'index'])->name('admin.reservations.index');
        Route::get('/create', [ReservationsController::class, 'create_reservations'])->name('admin.reservations.create')->middleware('can:reservations.create');
        Route::post('/store', [ReservationsController::class, 'storeAdmin'])->name('admin.reservations.store')->middleware('can:reservations.store');
        Route::get('/{id}/edit', [ReservationsController::class, 'edit'])->name('admin.reservations.edit')->middleware('can:reservations.edit');
        Route::put('/{id}', [ReservationsController::class, 'update'])->name('admin.reservations.update')->middleware('can:reservations.edit');
        Route::delete('/{id}', [ReservationsController::class, 'destroy'])->name('admin.reservations.destroy')->middleware('can:reservations.delete');
    });



    // Tickets
Route::prefix('Tickets')->middleware(['can:tickets.index'])->group(function () {
    Route::get('/create', [TicketsController::class, 'Create_ticket'])->name('tickets.create')->middleware('can:tickets.create');
    Route::post('/create', [TicketsController::class, 'traitement_create_ticket'])->name('tickets.traitement');
    Route::get('/index', [TicketsController::class, 'ticket'])->name('indextickets');
    Route::get('/editticket/{id}', [TicketsController::class, 'modifierticket'])->name('tickets.modifier')->middleware('can:tickets.edit');
    Route::put('/editticket/{id}', [TicketsController::class, 'modificationticket'])->name('tickets.modification')->middleware('can:tickets.edit');
    Route::delete('/delete/{id}', [TicketsController::class, 'supressionticket'])->name('tickets.supression')->middleware('can:tickets.delete');
    
});

    // Avis
    Route::prefix('Avis')->middleware(['can:avis.index'])->group(function () {
        Route::get('/create', [AviController::class, 'create_avis'])->name('avis')->middleware('can:avis.create');
        Route::post('/create', [AviController::class, 'traitement_create_avis'])->name('avis.traitement');
        Route::get('/index', [AviController::class, 'avis'])->name('indexavis');
        Route::get('/update/{id}', [AviController::class, 'modifieravis'])->name('avis.modifier')->middleware('can:avis.edit');
        Route::put('/update/{id}', [AviController::class, 'modificationavis'])->name('avis.modification')->middleware('can:avis.edit');
        Route::delete('/delete/{id}', [AviController::class, 'Supressionavis'])->name('avis.supression')->middleware('can:avis.delete');
    });

    // Gestion des avis (admin)
    Route::prefix('Avis')->middleware(['role:admin'])->name('Admin.Avis.')->group(function () {
        Route::get('/index', [AvisController::class, 'index'])->name('index');
        Route::patch('/{avis}/approuver', [AvisController::class, 'approuver'])->name('approuver');
        Route::patch('/{avis}/refuser', [AvisController::class, 'refuser'])->name('refuser');
        Route::post('/{avis}/repondre', [AvisController::class, 'repondre'])->name('repondre');
    });

    // Utilisateurs
    Route::prefix('Users')->middleware(['can:users.index'])->group(function () {
        Route::get('/create', [UserController::class, 'create_users'])->name('users')->middleware('can:users.create');
        Route::post('/create', [UserController::class, 'traitement_create_users'])->name('users.traitement')->middleware('can:users.create');
        Route::get('/index', [UserController::class, 'users'])->name('indexusers');
        Route::get('/ediuser/{id}', [UserController::class, 'modifierusers'])->name('users.modifier')->middleware('can:users.edit');
        Route::put('/editusers/{id}', [UserController::class, 'modificationusers'])->name('users.modification')->middleware('can:users.edit');
        Route::delete('/delete/{id}', [UserController::class, 'Supressionusers'])->name('users.supression')->middleware('can:users.delete');
    });

    // Rôles (Admin seulement)
    Route::prefix('Roles')->middleware(['role:admin'])->group(function () {
        Route::get('/index', [RoleController::class, 'index'])->name('admin.roles.index');
        Route::get('/create', [RoleController::class, 'create'])->name('admin.roles.create');
        Route::post('/', [RoleController::class, 'store'])->name('admin.roles.store');
        Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
        Route::put('/{id}', [RoleController::class, 'update'])->name('admin.roles.update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
        Route::post('/assign/{userId}', [RoleController::class, 'assignRoles'])->name('admin.roles.assign');
    });

    // Galeries
    Route::prefix('Galeries')->middleware(['can:galeries.index'])->group(function () {
        Route::get('/create', [GaleriesController::class, 'photo'])->name('photos')->middleware('can:galeries.create');
        Route::post('/create', [GaleriesController::class, 'store'])->name('Galeries.traitement');
        Route::get('/index', [GaleriesController::class, 'index'])->name('galeries.index');
        Route::get('/editgalerie/{id}', [GaleriesController::class, 'edit'])->name('galerie.modifier')->middleware('can:galeries.edit');
        Route::put('/editgalerie/{id}', [GaleriesController::class, 'update'])->name('galerie.update')->middleware('can:galeries.edit');
        Route::delete('/delete/{id}', [GaleriesController::class, 'Supressiongalerie'])->name('galerie.supression')->middleware('can:galeries.delete');
    });

    // Paiements admin
    Route::prefix('Paiement')->middleware(['can:paiement.index'])->group(function () {
        Route::get('/', [PaiementController::class, 'index'])->name('paiement.index');
        Route::get('/create', [PaiementController::class, 'create'])->name('paiement.create')->middleware('can:paiement.create');
        Route::post('/', [PaiementController::class, 'store'])->name('paiement.store')->middleware('can:paiement.create');
        Route::get('/{paiement}', [PaiementController::class, 'show'])->name('paiement.show')->middleware('can:paiement.show');
        Route::get('/{paiement}/edit', [PaiementController::class, 'edit'])->name('paiement.edit')->middleware('can:paiement.edit');
        Route::put('/{paiement}', [PaiementController::class, 'update'])->name('paiement.update')->middleware('can:paiement.edit');
        Route::delete('/{paiement}', [PaiementController::class, 'destroy'])->name('paiement.destroy')->middleware('can:paiement.delete');
    });

    // Pièces d'identité
    Route::prefix('PieceIdentite')->middleware(['can:pieces.index'])->group(function () {
        Route::get('/', [PieceIdentiteController::class, 'index'])->name('piece.index');
        Route::get('/create', [PieceIdentiteController::class, 'create'])->name('piece.create')->middleware('can:pieces.create');
        Route::post('/', [PieceIdentiteController::class, 'store'])->name('piece.store')->middleware('can:pieces.create');
        Route::get('/{piece}', [PieceIdentiteController::class, 'show'])->name('piece.show')->middleware('can:pieces.show');
        Route::get('/{piece}/edit', [PieceIdentiteController::class, 'edit'])->name('piece.edit')->middleware('can:pieces.edit');
        Route::put('/{piece}', [PieceIdentiteController::class, 'update'])->name('piece.update')->middleware('can:pieces.edit');
        Route::delete('/{piece}', [PieceIdentiteController::class, 'destroy'])->name('piece.destroy')->middleware('can:pieces.delete');
    });

    //la gestion des itineraire sur le site touristique 
    // Agences de voyage  ->middleware(['can:agence.index'])->middleware('can:agence.create')->middleware('can:agence.edit') ->middleware('can:agence.edit')->middleware('can:agence.delete')
    
Route::prefix('agence')->group(function () {
    Route::get('/create', [AgenceVoyageController::class, 'create'])->name('agence.create');
    Route::post('/create', [AgenceVoyageController::class, 'store'])->name('agence.store');
    Route::get('/index', [AgenceVoyageController::class, 'index'])->name('agence.index');
    Route::get('/edit/{id}', [AgenceVoyageController::class, 'edit'])->name('agence.edit');
    Route::put('/edit/{id}', [AgenceVoyageController::class, 'update'])->name('agence.update');
    Route::delete('/delete/{id}', [AgenceVoyageController::class, 'destroy'])->name('agence.delete');
});
// Itinéraires
Route::prefix('itineraire')->group(function () {
    Route::get('/create', [ItineraireController::class, 'create'])->name('itineraire.create');
    Route::post('/create', [ItineraireController::class, 'store'])->name('itineraire.store');
    Route::get('/index', [ItineraireController::class, 'index'])->name('itineraire.index');
    Route::get('/edit/{id}', [ItineraireController::class, 'edit'])->name('itineraire.edit');
    Route::put('/edit/{id}', [ItineraireController::class, 'update'])->name('itineraire.update');
    Route::delete('/delete/{id}', [ItineraireController::class, 'destroy'])->name('itineraire.delete');

Route::get('/itineraire-offres', [ItineraireController::class, 'indexpublic'])->name('itineraire.offres');
Route::get('/itineraire-offres/demande/{id}', [ItineraireController::class, 'demande'])->name('itineraire.demande');
Route::post('/itineraire-offres/demande/{id}', [ItineraireController::class, 'envoyer'])->name('itineraire.envoyer');

});
// Association Itinéraire - Site
Route::prefix('itineraire-site')->group(function () {
    Route::get('/create', [ItineraireSiteController::class, 'create'])->name('itineraire_site.create');
    Route::post('/create', [ItineraireSiteController::class, 'store'])->name('itineraire_site.store');
    Route::get('/index', [ItineraireSiteController::class, 'index'])->name('itineraire_site.index');
    Route::get('/edit/{id}', [ItineraireSiteController::class, 'edit'])->name('itineraire_site.edit');
    Route::put('/edit/{id}', [ItineraireSiteController::class, 'update'])->name('itineraire_site.update');
    Route::delete('/delete/{id}', [ItineraireSiteController::class, 'destroy'])->name('itineraire_site.delete');
});

Route::get('/itineraire-offres', [ItineraireController::class, 'indexpublic'])->name('itineraire.offres');
Route::get('/itineraire-offres/demande/{id}', [ItineraireController::class, 'demande'])->name('itineraire.demande');
Route::post('/itineraire-offres/demande/{id}', [ItineraireController::class, 'envoyer'])->name('itineraire.envoyer');

Route::post('/itineraire/{id}/demande', [DemandeParticipationController::class, 'store'])->name('itineraire.envoyer');
Route::post('/admin/demande/{id}/repondre', [DemandeParticipationController::class, 'repondre'])->name('demande.repondre');
Route::get('/itineraire-offres/{id}', [ItineraireController::class, 'showpublic'])->name('itineraire.showpublic');

});
