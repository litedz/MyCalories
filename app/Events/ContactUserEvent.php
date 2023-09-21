<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactUserEvent
{
    use Dispatchable, InteractsWithSockets, Queueable,SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public string $email, public string $name, public string $subject, public string $message)
    {

    }
}
