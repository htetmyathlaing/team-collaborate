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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

Broadcast::channel('chatroom.{group_id}', function ($user, $group_id) {
    return ['id' => $user->id, 'name' => $user->name];
    // return Auth::check();
    // return Message::latest()->with('user')->first();
});