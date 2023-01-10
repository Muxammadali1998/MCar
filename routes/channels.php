<?php

use App\Events\PeopleChange;
use Illuminate\Support\Facades\Broadcast;
use App\Events\PeopleEvent;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('people.{id}', PeopleEvent::class);
Broadcast::channel('peoplechange.{id}', PeopleChange::class);