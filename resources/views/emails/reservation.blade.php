@component('mail::message')
# Bonjour {{ $user->name }},

Nous avons le plaisir de confirmer votre réservation pour **{{ $event->nom }}** ✅

**📅 Date de l'événement :** {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y H:i') }}  
**🕒 Réservation effectuée le :** {{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y H:i') }}  
**📍 Lieu :** {{ $event->lieu }}, {{ $event->pays ?? 'Bénin' }}  
@if($reservation && isset($reservation->nombre_personnes))
**👥 Nombre de participants :** {{ $reservation->nombre_personnes }}
@endif

---

### Préparez-vous à vivre une expérience unique !  
Ne manquez pas cet événement exceptionnel où chaque instant compte. Nous avons hâte de vous accueillir et de partager ce moment magique avec vous.  

@component('mail::button', ['url' => url("/evenements/{$event->id}")])
Voir les détails de l'événement
@endcomponent

Si vous avez des questions, n’hésitez pas à nous contacter via notre plateforme.  

Cordialement,<br>
**L’équipe Toché - Gestion des sites touristiques du Bénin**
@endcomponent
