<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNewsletter extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Bienvenue dans la newsletter Toché 🎉')
            ->greeting('Salut et bienvenue sur Toché 👋')
            ->line("Tu viens de rejoindre notre communauté ! 🌍")
            ->line("Désormais, tu seras le premier à découvrir nos sites touristiques, événements et bons plans.")
            ->action('Découvrir Toché', url('/'))
            ->salutation('À bientôt, l’équipe Toché 🚀');
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
