<x-app-layout>
    <div class="bg-white shadow rounded-2xl p-8 space-y-6">
        <div>
            <h1 class="text-2xl font-semibold">Modifier l'événement</h1>
            <p class="text-sm text-slate-600">Mettez à jour les informations de l'événement.</p>
        </div>

        @if (session('success'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="title" value="Titre" />
                <x-text-input id="title" name="title" type="text" class="mt-2 block w-full" value="{{ old('title', $event->ba_title) }}" required />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description" value="Description" />
                <textarea id="description" name="description" rows="4" class="mt-2 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $event->ba_description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <x-input-label for="start_date" value="Date de début" />
                    <x-text-input id="start_date" name="start_date" type="datetime-local" class="mt-2 block w-full" value="{{ old('start_date', optional($event->ba_start_date)->format('Y-m-d\\TH:i')) }}" required />
                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="end_date" value="Date de fin" />
                    <x-text-input id="end_date" name="end_date" type="datetime-local" class="mt-2 block w-full" value="{{ old('end_date', optional($event->ba_end_date)->format('Y-m-d\\TH:i')) }}" required />
                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <x-input-label for="place" value="Lieu" />
                    <x-text-input id="place" name="place" type="text" class="mt-2 block w-full" value="{{ old('place', $event->ba_place) }}" required />
                    <x-input-error :messages="$errors->get('place')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="capacity" value="Capacité" />
                    <x-text-input id="capacity" name="capacity" type="number" min="1" class="mt-2 block w-full" value="{{ old('capacity', $event->ba_capacity) }}" required />
                    <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
                </div>
            </div>

            <div>
                <x-input-label for="category_id" value="Catégorie" />
                <select id="category_id" name="category_id" class="mt-2 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    <option value="">Sélectionner une catégorie</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->ba_id }}" @selected(old('category_id', $event->ba_category_id) == $category->ba_id)>
                            {{ $category->ba_name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <x-input-label for="status" value="Statut" />
                    <select id="status" name="status" class="mt-2 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        <option value="active" @selected(old('status', $event->ba_status) === 'active')>Actif</option>
                        <option value="archived" @selected(old('status', $event->ba_status) === 'archived')>Archivé</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="image" value="Image" />
                    <input id="image" name="image" type="file" class="mt-2 block w-full text-sm text-slate-500" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <x-input-label for="price" value="Prix" />
                    <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="mt-2 block w-full" value="{{ old('price', $event->ba_price) }}" required />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
                <div class="flex items-center gap-3 pt-6">
                    <input type="hidden" name="is_free" value="0" />
                    <input id="is_free" name="is_free" type="checkbox" value="1" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" @checked(old('is_free', $event->ba_is_free)) />
                    <label for="is_free" class="text-sm text-slate-700">Événement gratuit</label>
                    <x-input-error :messages="$errors->get('is_free')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button type="submit">Mettre à jour</x-primary-button>
                <a href="{{ route('admin.events.index') }}" class="text-sm text-slate-600 hover:text-slate-800">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
