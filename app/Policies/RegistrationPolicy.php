<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class RegistrationPolicy
{
    public function create(User $user, Event $event): bool
    {
        if ($event->ba_status !== 'active') {
            return false;
        }

        if ($event->isFull()) {
            return false;
        }

        return ! $event->registrations()
            ->where('ba_user_id', $user->ba_id)
            ->exists();
    }
}
