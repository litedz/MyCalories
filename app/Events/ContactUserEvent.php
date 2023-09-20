<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactUserEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels,Queueable;

    /**
     * Create a new event instance.
     */
    public function __construct(public string $email,public string $name,public string $subject,public string $message)
    {
        
    }
}
