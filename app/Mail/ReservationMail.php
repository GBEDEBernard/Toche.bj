<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $user;
    public $event;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
        $this->user = $reservation->user;
        $this->event = $reservation->evenement;
    }

    public function build()
    {
        return $this->subject("Réservation confirmée pour {$this->event->nom} 🎟️")
                    ->markdown('emails.reservation')
                    ->with([
                        'reservation' => $this->reservation,
                        'user' => $this->user,
                        'event' => $this->event,
                    ]);
    }
}
