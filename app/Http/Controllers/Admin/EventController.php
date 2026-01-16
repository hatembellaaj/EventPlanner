<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventStoreRequest;
use App\Http\Requests\Admin\EventUpdateRequest;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Event::class);

        $events = Event::query()
            ->with('category')
            ->withCount('registrations')
            ->latest('ba_start_date')
            ->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        $this->authorize('create', Event::class);

        $categories = Category::query()
            ->orderBy('ba_name')
            ->get();

        return view('admin.events.create', compact('categories'));
    }

    public function store(EventStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Event::class);

        $data = $request->validated();

        $event = Event::create([
            'ba_title' => $data['title'],
            'ba_description' => $data['description'],
            'ba_start_date' => $data['start_date'],
            'ba_end_date' => $data['end_date'],
            'ba_place' => $data['place'],
            'ba_capacity' => $data['capacity'],
            'ba_price' => $data['price'],
            'ba_is_free' => $data['is_free'],
            'ba_status' => $data['status'],
            'ba_category_id' => $data['category_id'],
            'ba_created_by' => $request->user()->ba_id,
        ]);

        return redirect()
            ->route('admin.events.edit', $event)
            ->with('success', 'Événement créé avec succès.');
    }

    public function show(Event $event): View
    {
        $this->authorize('view', $event);

        $event->loadMissing(['category', 'creator'])
            ->loadCount('registrations');

        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event): View
    {
        $this->authorize('update', $event);

        $categories = Category::query()
            ->orderBy('ba_name')
            ->get();

        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(EventUpdateRequest $request, Event $event): RedirectResponse
    {
        $this->authorize('update', $event);

        $data = $request->validated();

        $event->update([
            'ba_title' => $data['title'],
            'ba_description' => $data['description'],
            'ba_start_date' => $data['start_date'],
            'ba_end_date' => $data['end_date'],
            'ba_place' => $data['place'],
            'ba_capacity' => $data['capacity'],
            'ba_price' => $data['price'],
            'ba_is_free' => $data['is_free'],
            'ba_status' => $data['status'],
            'ba_category_id' => $data['category_id'],
        ]);

        return redirect()
            ->route('admin.events.edit', $event)
            ->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->authorize('delete', $event);

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Événement supprimé avec succès.');
    }
}
