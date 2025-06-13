<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Newsletter;
use App\Models\Evenement;
use App\Models\Site_Touristique;
use App\Notifications\EventReminderNotification;
use App\Notifications\InactiveSitesNotification;
use Carbon\Carbon;

class SendEventReminders extends Command
{
    protected $signature = 'app:send-event-reminders';
    protected $description = 'Envoie des rappels d\'événements à venir et des suggestions de sites touristiques oubliés.';

    public function handle()
    {
        $newsletters = Newsletter::all();

        if ($newsletters->isEmpty()) {
            $this->info('Aucun abonné à la newsletter trouvé.');
            return;
        }

        // 🎉 Événements dans 3 jours
        $events = Evenement::whereDate('date', Carbon::today()->addDays(3))->get();

        if ($events->isNotEmpty()) {
            foreach ($newsletters as $newsletter) {
                $newsletter->notify(new EventReminderNotification($events));
            }
            $this->info('Notifications de rappel d\'événements envoyées !');
        } else {
            $this->info('Aucun événement prévu dans 3 jours.');
        }

        // 🏞️ Sites inactifs
        $inactiveSites = Site_Touristique::where('last_viewed_at', '<', Carbon::now()->subMonths(2))
                                        ->orWhereNull('last_viewed_at')
                                        ->get();

        if ($inactiveSites->isNotEmpty()) {
            foreach ($newsletters as $newsletter) {
                $newsletter->notify(new InactiveSitesNotification($inactiveSites));
            }
            $this->info('Suggestions de sites touristiques envoyées !');
        } else {
            $this->info('Aucun site inactif trouvé.');
        }

        $this->info('Commande exécutée avec succès ✔️');
    }
}