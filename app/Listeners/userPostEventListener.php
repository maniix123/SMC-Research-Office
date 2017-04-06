<?php

namespace App\Listeners;

use App\Events\userPostEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\notify;
class userPostEventListener
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

    public function userRecordPost(userPostEvent $event)
    {
        $notification = new notify;
        $notification->action = $event->user . ' submitted a journal for review.';
        $notification->is_read = 'false';
        $notification->URL = '/Admin/PostReview/' . $event->id;
        $notification->save();
    }
    
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\userPostEvent',
            'App\Listeners\userPostEventListener@userRecordPost'
            );
    }
}
