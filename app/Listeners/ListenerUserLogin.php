<?php

namespace App\Listeners;

use App\Events\EventUserLogin;
use App\Functions\WithdrawFunction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ListenerUserLogin
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
     * @param  EventUserLogin  $event
     * @return void
     */
    public function handle(EventUserLogin $event)
    {
        // Check if User Can withdraw

    }
}
