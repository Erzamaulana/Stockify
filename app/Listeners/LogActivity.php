<?php

namespace App\Listeners;

use App\Events\ActivityOccurred;
use App\Models\ActivityLog;

class LogActivity
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ActivityOccurred  $event
     * @return void
     */
    public function handle(ActivityOccurred $event)
    {
        ActivityLog::create([
            'user_id' => $event->userId,
            'activity' => $event->action,
            'description' => $event->description,
        ]);
    }
}
