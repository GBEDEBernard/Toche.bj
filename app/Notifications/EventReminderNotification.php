<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EventReminderNotification extends Notification
{
    use Queueable;

    protected $events;

    public function __construct($events)
    {
        $this->events = $events;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $mailMessage = (new MailMessage)
            ->subject('Événements à venir dans 3 jours !')
            ->greeting('Salut !')
            ->line('Voici les événements qui arrivent bientôt :');

        foreach ($this->events as $event) {
            $mailMessage->line("- " . $event->nom . " le " . $event->date->format('d/m/Y'));
        }

        $mailMessage->salutation('On se voit là-bas ? 😉');

        return $mailMessage;
    }
}
