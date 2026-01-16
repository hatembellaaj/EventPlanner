<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventStoreRequest;
use App\Http\Requests\Admin\EventUpdateRequest;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        $imagePath = $this->storeEventImage($request->file('image'));

        $event = Event::create([
            'ba_title' => $data['title'],
            'ba_description' => $data['description'],
            'ba_start_date' => $data['start_date'],
            'ba_end_date' => $data['end_date'],
            'ba_place' => $data['place'],
            'ba_capacity' => $data['capacity'],
            'ba_price' => $data['price'],
            'ba_is_free' => $data['is_free'],
            'ba_image' => $imagePath,
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

        $payload = [
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
        ];

        if ($request->hasFile('image')) {
            $this->deleteEventImage($event->ba_image);
            $payload['ba_image'] = $this->storeEventImage($request->file('image'));
        }

        $event->update($payload);

        return redirect()
            ->route('admin.events.edit', $event)
            ->with('success', 'Événement mis à jour avec succès.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->authorize('delete', $event);

        if ($event->ba_image) {
            $this->deleteEventImage($event->ba_image);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Événement supprimé avec succès.');
    }

    private function storeEventImage(?UploadedFile $image): ?string
    {
        if (! $image) {
            return null;
        }

        $directory = public_path('images/events');

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = Str::uuid().'.'.$image->getClientOriginalExtension();
        $image->move($directory, $filename);

        return 'images/events/'.$filename;
    }

    private function deleteEventImage(?string $imagePath): void
    {
        if (! $imagePath) {
            return;
        }

        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $publicPath = public_path($imagePath);
        if (file_exists($publicPath)) {
            unlink($publicPath);
        }

        $legacyPublicPath = public_path('images/'.$imagePath);
        if (file_exists($legacyPublicPath)) {
            unlink($legacyPublicPath);
        }
    }
}
