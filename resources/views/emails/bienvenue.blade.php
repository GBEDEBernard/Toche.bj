@component('mail::message')
# Salut {{ $user->email }} 👋

Bienvenue sur **Toché** — la plateforme de gestion des sites touristiques du Bénin.

Nous sommes ravis de vous compter parmi nous ! Découvre des événements, réserve ta place et vis des expériences uniques.

@component('mail::button', ['url' => $url])
Visiter Toché
@endcomponent

Merci,<br>
**L’équipe Toché**
@endcomponent
