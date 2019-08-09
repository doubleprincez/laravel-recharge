<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventCreateCredentials implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;
    public $ref_id;

    /**
     * Create a new event instance.
     *
     * @param $ref_id
     * @param $user
     */
    public function __construct($ref_id, $user)
    {
        $this->ref_id = $ref_id;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [];
    }
}
