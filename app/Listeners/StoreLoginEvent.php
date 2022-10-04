<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use App\Models\LoginEvents;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreLoginEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LoginEvent  $event
     * @return void
     */
    public function handle(LoginEvent $event) :void
    {
        $toSave = new LoginEvents();
        $toSave->user_id = $event->user->id;
        $toSave->event_time = Carbon::now();
        $toSave->type = $event->type;

        LoginEvents::clearLatest($event->user->id, $event->type);

        $toSave->save();
    }
}
