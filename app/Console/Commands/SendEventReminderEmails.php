<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Evenement;
use App\Mail\EvenementRappelMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendEventReminderEmails extends Command
{
    protected $signature = 'evenements:rappels';
    protected $description = 'Envoie des mails de rappel pour les événements à venir.';

    public function handle()
    {
        $delais = [
            28 => "4 semaines",
            21 => "3 semaines",
            14 => "2 semaines",
            7  => "1 semaine",
            3  => "3 jours",
            1  => "demain",
        ];

        foreach ($delais as $jours => $texte) {
            $dateCible = Carbon::now()->addDays($jours)->toDateString();
            $evenements = Evenement::whereDate('date', $dateCible)->get();

            foreach ($evenements as $event) {
                foreach ($event->reservations as $reservation) {
                    $user = $reservation->user;
                    Mail::to($user->email)->send(new EvenementRappelMail($event, $user, $texte));
                }
            }
        }

        $this->info('Rappels envoyés.');
    }
}
