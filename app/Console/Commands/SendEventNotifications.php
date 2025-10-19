<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Evenement;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventNotification;
use Carbon\Carbon;

class SendEventNotifications extends Command
{
    protected $signature = 'send:event-notifications';
    protected $description = 'Envoyer des notifications aux abonnés pour les événements proches';

    public function handle()
    {
$events = Evenement::all(); // temporaire
                         

        $subscribers = Newsletter::all();

        foreach ($events as $event) {
            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)->queue(new EventNotification($event));
            }
        }

        $this->info('Notifications envoyées aux abonnés pour les événements proches.');
    }
}
