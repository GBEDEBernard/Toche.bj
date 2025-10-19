<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\BienvenueUserMail;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMail implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(Registered $event)
    {
        Mail::to($event->user->email)->send(new BienvenueUserMail($event->user));
    }
}
