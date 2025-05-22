<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $users_id
 * @property int $site_touristique_id
 * @property string $message
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Site_touristique|null $site_touristiques
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi whereSiteTouristiqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avi whereUsersId($value)
 * @mixin \Eloquent
 */
	class Avi extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $types
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Site_touristique> $site_touristiques
 * @property-read int|null $site_touristiques_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categorie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categorie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categorie query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categorie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categorie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categorie whereTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categorie whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Categorie extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $objet
 * @property string $email
 * @property string $contenu
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereObjet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Contact extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $site_touristique_id
 * @property string $nom
 * @property string $lieu
 * @property string $date
 * @property string $photo
 * @property string $sponsor
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Galerie> $galeries
 * @property-read int|null $galeries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reservation> $reservations
 * @property-read int|null $reservations_count
 * @property-read \App\Models\Site_touristique $site_touristique
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket> $tickets
 * @property-read int|null $tickets_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereLieu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereSiteTouristiqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereSponsor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evenement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Evenement extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $site_touristique_id
 * @property int $evenement_id
 * @property string $nom
 * @property string $photo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Evenement $evenement
 * @property-read \App\Models\Site_touristique $site_touristique
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie whereEvenementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie whereSiteTouristiqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Galerie whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Galerie extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $evenement_id
 * @property int $users_id
 * @property int $nombre
 * @property int $prix
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Evenement $evenement
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereEvenementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reservation whereUsersId($value)
 * @mixin \Eloquent
 */
	class Reservation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $categorie_id
 * @property string $nom
 * @property string $pays
 * @property string $departement
 * @property string $commune
 * @property string $email
 * @property string $photo
 * @property string $contact
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Avi> $avis
 * @property-read int|null $avis_count
 * @property-read \App\Models\Categorie|null $categorie
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Evenement> $evenements
 * @property-read int|null $evenements_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Galerie> $galeries
 * @property-read int|null $galeries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Visite> $visites
 * @property-read int|null $visites_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereCategorieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereCommune($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereDepartement($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique wherePays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Site_touristique whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Site_touristique extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $evenement_id
 * @property string $type
 * @property int $nombres
 * @property string $prix
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Evenement $evenement
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereEvenementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereNombres($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ticket whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Ticket extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $photo
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $role_id
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Role|null $role
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $site_touristique_id
 * @property int $users_id
 * @property int $telephone
 * @property int $nombre
 * @property int $prix
 * @property string $date
 * @property string $chemin_ticket
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Site_touristique $site_touristique
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereCheminTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite wherePrix($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereSiteTouristiqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Visite whereUsersId($value)
 * @mixin \Eloquent
 */
	class Visite extends \Eloquent {}
}

