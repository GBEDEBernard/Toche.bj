<?php

namespace App\Notifications;

use App\Models\Avis;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAvisNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $avis;

    public function __construct(Avis $avis)
    {
        $this->avis = $avis;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $avisable = $this->avis->avisable;
        return [
            'avis_id' => $this->avis->id,
            'message' => "Nouvel avis soumis sur {$avisable->nom} par {$this->avis->user->name}.",
            'type' => 'avis',
            'avisable_type' => $this->avis->avisable_type,
            'avisable_id' => $this->avis->avisable_id,
        ];
    }

    public function toMail($notifiable)
    {
        $avisable = $this->avis->avisable;
        return (new MailMessage)
            ->subject('Nouvel avis soumis')
            ->line("Un nouvel avis a été soumis sur {$avisable->nom} par {$this->avis->user->name}.")
            ->action('Voir l’avis', route('Admin.Avis.index'))
            ->line('Merci de vérifier et d’approuver cet avis.');
    }
}