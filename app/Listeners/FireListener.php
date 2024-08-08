<?php

namespace App\Listeners;

use App\Models\Invoice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\FireEvent;
use App\Notifications\RegisterNotification;
class FireListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FireEvent $event): void
    {
        $event->user->notify( new RegisterNotification());
    }
}
