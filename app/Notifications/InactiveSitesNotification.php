<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class InactiveSitesNotification extends Notification
{
    use Queueable;

    protected $sites;

    public function __construct($sites)
    {
        $this->sites = $sites;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mailMessage = (new MailMessage)
            ->subject('Sites touristiques à redécouvrir !')
            ->greeting('Hello ! 👋')
            ->line('Voici des sites touristiques que vous n\'avez pas visités depuis un moment :');

        foreach ($this->sites as $site) {
            $mailMessage->line("- " . $site->nom);
        }

        $mailMessage->line('N’hésitez pas à aller y jeter un œil, il y a sûrement du nouveau à découvrir !')
                    ->salutation('À bientôt sur notre site !');

        return $mailMessage;
    }
}
