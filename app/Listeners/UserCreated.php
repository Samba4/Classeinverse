<?php

namespace App\Listeners;

use App\{
    Events\UserCreated as UserCreatedEvent,
    Notifications\UserCreated as SendNotificationUserCreated,
    Models\User
};
use Illuminate\Support\Facades\Notification;

class UserCreated
{
    public function handle(UserCreatedEvent $event)
    {
        Notification::send(User::whereRole('admin')->first(), new SendNotificationUserCreated($event->user));
    }
}
