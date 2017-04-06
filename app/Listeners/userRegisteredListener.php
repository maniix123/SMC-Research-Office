<?php

namespace App\Listeners;

use App\Events\userRegistered;
use App\notify;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class userRegisteredListener
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

    public function userAlertAdmin(userRegistered $event)
    {
        
    }
    
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\userRegistered',
            'App\Listeners\userRegisteredListener@userAlertAdmin'
            );
    }
}
