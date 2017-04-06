<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class userPostEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;
    public $user;
    public $id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $id)
    {
        $this->user = $user;
        $this->id = $id;
    }

    public function broadcastOn()
    {
        return ['userPostEventChannel'];
    }
    public function broadcastWith()
    {
        return ['name' => $this->user, 'id' => $this->id];
    }
}
