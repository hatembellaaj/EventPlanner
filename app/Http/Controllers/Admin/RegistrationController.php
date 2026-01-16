<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function index(): View
    {
        $filters = [
            'event' => request('event'),
            'q' => request('q'),
        ];

        $events = Event::query()
            ->orderBy('ba_start_date')
            ->get();

        $registrations = Registration::query()
            ->with(['user', 'event'])
            ->when($filters['event'], function ($query, $eventId) {
                $query->where('ba_event_id', $eventId);
            })
            ->when($filters['q'], function ($query, $search) {
                $search = trim($search);

                $query->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('ba_name', 'like', "%{$search}%")
                        ->orWhere('ba_email', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('ba_created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.registrations.index', compact('events', 'filters', 'registrations'));
    }
}
