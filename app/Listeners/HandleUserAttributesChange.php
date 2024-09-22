<?php

namespace App\Listeners;

use App\Events\UserAttributesChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class HandleUserAttributesChange
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
    public function handle(UserAttributesChanged $event): void
    {
        $usersToUpdate = Cache::get('users_to_update', []);
        $usersToUpdate[] = $event->user->toArray();
        Cache::put('users_to_update', $usersToUpdate, now()->addMinutes(10));
    }
}
