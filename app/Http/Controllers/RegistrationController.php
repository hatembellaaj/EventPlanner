<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function index(): View
    {
        $user = request()->user();

        $events = Event::query()
            ->with('category')
            ->whereHas('registrations', function ($query) use ($user) {
                $query->where('ba_user_id', $user->ba_id);
            })
            ->orderBy('ba_start_date')
            ->get();

        return view('registrations.index', compact('events'));
    }

    public function store(Event $event): RedirectResponse
    {
        $user = request()->user();

        $result = DB::transaction(function () use ($event, $user) {
            $lockedEvent = Event::query()
                ->whereKey($event->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedEvent->ba_status !== 'active') {
                return [
                    'status' => 'error',
                    'message' => "L'événement n'est pas actif.",
                ];
            }

            $alreadyRegistered = Registration::query()
                ->where('ba_event_id', $lockedEvent->ba_id)
                ->where('ba_user_id', $user->ba_id)
                ->exists();

            if ($alreadyRegistered) {
                return [
                    'status' => 'error',
                    'message' => "Vous êtes déjà inscrit à cet événement.",
                ];
            }

            $remainingSeats = max(0, (int) $lockedEvent->ba_capacity - $lockedEvent->registrations()->count());

            if ($remainingSeats <= 0) {
                return [
                    'status' => 'error',
                    'message' => "Cet événement est complet.",
                ];
            }

            $lockedEvent->registrations()->create([
                'ba_user_id' => $user->ba_id,
                'ba_event_id' => $lockedEvent->ba_id,
            ]);

            return [
                'status' => 'success',
                'message' => 'Inscription confirmée.',
            ];
        });

        if ($result['status'] === 'success') {
            return redirect()
                ->route('events.show', $event)
                ->with('success', $result['message']);
        }

        return redirect()
            ->route('events.show', $event)
            ->withErrors(['registration' => $result['message']]);
    }

    public function destroy(Event $event): RedirectResponse
    {
        $user = request()->user();

        if ($event->ba_start_date?->isPast()) {
            return redirect()
                ->route('registrations.index')
                ->withErrors(['registration' => "Vous ne pouvez plus vous désinscrire après le début de l'événement."]);
        }

        $registration = Registration::query()
            ->where('ba_event_id', $event->ba_id)
            ->where('ba_user_id', $user->ba_id)
            ->first();

        if (! $registration) {
            return redirect()
                ->route('registrations.index')
                ->withErrors(['registration' => "Vous n'êtes pas inscrit à cet événement."]);
        }

        $registration->delete();

        return redirect()
            ->route('registrations.index')
            ->with('success', 'Désinscription confirmée.');
    }
}
