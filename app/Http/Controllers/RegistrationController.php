<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;

class RegistrationController extends Controller
{
    public function store(Event $event): RedirectResponse
    {
        $this->authorize('create', [Registration::class, $event]);

        $event->registrations()->create([
            'ba_user_id' => request()->user()->ba_id,
            'ba_event_id' => $event->ba_id,
        ]);

        return redirect()->route('events.show', $event);
    }
}
