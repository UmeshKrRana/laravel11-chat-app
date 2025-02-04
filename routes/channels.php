<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat-channel.{receiverId}', function (User $user, $receiverId) {
    return (int) $user->id === (int) $receiverId;
});

Broadcast::channel('unread-channel.{receiverId}', function (User $user, $receiverId) {
    return (int) $user->id === (int) $receiverId;
});
