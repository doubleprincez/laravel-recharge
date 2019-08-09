<?php

namespace App\Listeners;

use App\Events\EventCreateCredentials;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ListenerCreateCredentials
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
     * @param  EventCreateCredentials  $event
     * @return void
     */
    public function handle(EventCreateCredentials $event)
    {

    }

}
