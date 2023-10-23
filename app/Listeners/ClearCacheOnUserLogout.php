<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\ClearCacheOnLogout;
use Illuminate\Auth\Events\Logout;


class ClearCacheOnUserLogout
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
    public function handle(Logout $event)
    {
        ClearCacheOnLogout::dispatch($event->users->id);
    }
}
