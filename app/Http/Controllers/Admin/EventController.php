<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        Gate::authorize('admin');

        return view('admin.events.index');
    }

    public function edit(Event $event): View
    {
        Gate::authorize('admin');

        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $this->authorize('update', $event);

        $event->update($request->validate([
            'ba_title' => ['sometimes', 'string', 'max:255'],
            'ba_description' => ['sometimes', 'string'],
            'ba_start_date' => ['sometimes', 'date'],
            'ba_end_date' => ['sometimes', 'date'],
            'ba_place' => ['sometimes', 'string', 'max:255'],
            'ba_capacity' => ['sometimes', 'integer', 'min:0'],
            'ba_price' => ['sometimes', 'numeric', 'min:0'],
            'ba_is_free' => ['sometimes', 'boolean'],
            'ba_status' => ['sometimes', 'string', 'max:50'],
            'ba_category_id' => ['sometimes', 'integer'],
        ]));

        return redirect()->route('admin.events.edit', $event);
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->authorize('delete', $event);

        $event->delete();

        return redirect()->route('admin.events.index');
    }
}
