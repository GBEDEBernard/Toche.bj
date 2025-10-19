@component('mail::message')
# Salut {{ $user->name }}

Petit rappel : **{{ $event->nom }}** approche — dans **{{ $delaiTexte }}**.

**Lieu :** {{ $event->lieu }}  
**Date :** {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y H:i') }}

Si tu as besoin d'annuler ou modifier ta réservation, rends-toi sur ton compte.

@component('mail::button', ['url' => url("/evenements/{$event->id}")])
Voir les détails
@endcomponent

À bientôt,<br>
**L’équipe Toché**
@endcomponent
