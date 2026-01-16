<x-app-layout>
    <div class="mx-auto max-w-3xl space-y-10">
        <div class="text-center">
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-300">Event Planner</p>
            <h1 class="mt-3 text-3xl font-semibold text-slate-900">Create Event</h1>
        </div>

        <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data" class="space-y-8 rounded-[28px] bg-slate-50 p-8 shadow-sm">
            @csrf

            <div>
                <x-input-label for="title" value="Event Title" class="text-xs uppercase tracking-widest text-slate-400" />
                <x-text-input id="title" name="title" type="text" class="mt-3 block w-full" value="{{ old('title') }}" required />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="category_id" value="Category" class="text-xs uppercase tracking-widest text-slate-400" />
                <select id="category_id" name="category_id" class="mt-3 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-100" required>
                    <option value="">Select category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->ba_id }}" @selected(old('category_id') == $category->ba_id)>
                            {{ $category->ba_name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <x-input-label for="start_date" value="Start date" class="text-xs uppercase tracking-widest text-slate-400" />
                    <x-text-input id="start_date" name="start_date" type="datetime-local" class="mt-3 block w-full" value="{{ old('start_date') }}" required />
                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="end_date" value="End date" class="text-xs uppercase tracking-widest text-slate-400" />
                    <x-text-input id="end_date" name="end_date" type="datetime-local" class="mt-3 block w-full" value="{{ old('end_date') }}" required />
                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <x-input-label for="place" value="Place" class="text-xs uppercase tracking-widest text-slate-400" />
                    <x-text-input id="place" name="place" type="text" class="mt-3 block w-full" value="{{ old('place') }}" required />
                    <x-input-error :messages="$errors->get('place')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="capacity" value="Capacity" class="text-xs uppercase tracking-widest text-slate-400" />
                    <x-text-input id="capacity" name="capacity" type="number" min="1" class="mt-3 block w-full" value="{{ old('capacity') }}" required />
                    <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <x-input-label for="price" value="Pricing" class="text-xs uppercase tracking-widest text-slate-400" />
                    <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="mt-3 block w-full" value="{{ old('price', 0) }}" required />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="status" value="Status" class="text-xs uppercase tracking-widest text-slate-400" />
                    <select id="status" name="status" class="mt-3 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-100" required>
                        <option value="active" @selected(old('status', 'active') === 'active')>Active</option>
                        <option value="archived" @selected(old('status') === 'archived')>Archived</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="hidden" name="is_free" value="0" />
                <input id="is_free" name="is_free" type="checkbox" value="1" class="h-4 w-4 rounded border-slate-300 text-purple-600 focus:ring-purple-200" @checked(old('is_free')) />
                <label for="is_free" class="text-sm text-slate-600">Free access</label>
                <x-input-error :messages="$errors->get('is_free')" class="mt-2" />
            </div>

            <div class="space-y-4">
                <h2 class="text-lg font-semibold text-slate-900">Event Description</h2>
                <div>
                    <x-input-label for="image" value="Event image" class="text-xs uppercase tracking-widest text-slate-400" />
                    <input id="image" name="image" type="file" accept="image/png,image/jpeg,image/webp" class="mt-3 block w-full rounded-xl border border-dashed border-slate-200 bg-white px-4 py-6 text-sm text-slate-500" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="description" value="Event description" class="text-xs uppercase tracking-widest text-slate-400" />
                    <textarea id="description" name="description" rows="5" class="mt-3 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-100">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button type="submit" class="w-full justify-center py-3">Create event</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
