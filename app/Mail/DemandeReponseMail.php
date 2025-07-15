<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DemandeReponseMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $nom;
    public $messageAdmin;
    public $itineraire;

    public function __construct($nom, $messageAdmin, $itineraire)
    {
        $this->nom = $nom;
        $this->messageAdmin = $messageAdmin;
        $this->itineraire = $itineraire;
    }

    public function build()
    {
        return $this->subject('Réponse à votre demande de participation')
                    ->view('emails.reponse_demande');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Demande Reponse Mail',
        );
    }

    /**
     * Get the message content definition.
     */
 
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
