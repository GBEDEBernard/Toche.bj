<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EvenementRappelMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $user;
    public $delaiTexte;

    public function __construct($event, $user, $delaiTexte)
    {
        $this->event = $event;
        $this->user = $user;
        $this->delaiTexte = $delaiTexte;
    }

    public function build()
    {
        $subject = "Rappel : {$this->event->nom} — dans {$this->delaiTexte}";
        return $this->subject($subject)
                    ->markdown('emails.rappel')
                    ->with([
                        'event' => $this->event,
                        'user' => $this->user,
                        'delaiTexte' => $this->delaiTexte
                    ]);
    }
}
