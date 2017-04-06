<?php

namespace App\Listeners;

use App\Events\userLoginEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\notify;
class userLoginEventListener
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

    public function userLogin(userLoginEvent $event)
    {
        $notification = new notify;
        $notification->action = $event->user . ' logged in.';
        $notification->URL = '/Admin/Notifications';
        $notification->is_read = 'false';
        $notification->save();
    }
    
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\userLoginEvent',
            'App\Listeners\userLoginEventListener@userLogin'
            );
    }
}
