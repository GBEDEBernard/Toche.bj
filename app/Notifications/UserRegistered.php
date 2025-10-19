<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegistered extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // mail et base de données
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Bienvenue sur Toché !')
                    ->greeting("Salut {$this->user->name} !")
                    ->line('Merci de vous être inscrit sur Toché.')
                    ->action('Découvrir les sites', url('/sites'))
                    ->line('Nous sommes ravis de vous compter parmi nous !');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Bienvenue {$this->user->name} sur Toché !",
        ];
    }
}
