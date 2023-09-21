<?php

namespace App\Listeners;

use App\Events\ContactUserEvent;
use App\Mail\UserAdvice;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class ContacListener
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
    public function handle(ContactUserEvent $event): void
    {

        $mailToUser = Mail::to('maamarxx@mail.com')->send(new UserAdvice($event->name, $event->subject, $event->message));

        if ($mailToUser) {
            Notification::make()
                ->title('Mailed Success to : <br>'.$event->email)
                ->success()
                ->send();
        }
    }
}
