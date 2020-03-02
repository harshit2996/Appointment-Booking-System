<?php

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

Broadcast::channel('user.{id}', function ($user, $id) {
    return ((int) $user->id === (int) $id || ($user->isAdmin));
});

Broadcast::channel('admin.{id}', function ($user, $id) {
    return ((int) $user->id === (int) $id || ($user->isAdmin));
});

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('online', function ($user) {
    if (auth()->check()) {
        return $user->toArray();
    }
});