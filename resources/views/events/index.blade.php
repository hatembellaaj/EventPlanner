<x-app-layout>
    <div class="space-y-8">
        <div class="bg-white shadow rounded-2xl p-6">
            <form method="GET" action="{{ route('events.index') }}" class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
                <div class="xl:col-span-2">
                    <label for="q" class="text-sm font-medium text-slate-700">Rechercher</label>
                    <input
                        id="q"
                        name="q"
                        type="search"
                        value="{{ $filters['q'] }}"
                        placeholder="Titre ou lieu"
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
                <div>
                    <label for="category" class="text-sm font-medium text-slate-700">Catégorie</label>
                    <select
                        id="category"
                        name="category"
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        <option value="">Toutes les catégories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->ba_id }}" @selected($filters['category'] == $category->ba_id)>
                                {{ $category->ba_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="date_from" class="text-sm font-medium text-slate-700">Date début</label>
                    <input
                        id="date_from"
                        name="date_from"
                        type="date"
                        value="{{ $filters['date_from'] }}"
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
                <div>
                    <label for="date_to" class="text-sm font-medium text-slate-700">Date fin</label>
                    <input
                        id="date_to"
                        name="date_to"
                        type="date"
                        value="{{ $filters['date_to'] }}"
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
                <div class="flex items-end gap-3">
                    <label for="free" class="inline-flex items-center gap-2 text-sm font-medium text-slate-700">
                        <input
                            id="free"
                            name="free"
                            type="checkbox"
                            value="1"
                            class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                            @checked($filters['free'] === '1')
                        />
                        Gratuit uniquement
                    </label>
                    <button
                        type="submit"
                        class="ml-auto inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                    >
                        Filtrer
                    </button>
                </div>
            </form>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($events as $event)
                <div class="flex h-full flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm">
                    <div class="relative">
                        @if ($event->imageUrl())
                            <img src="{{ $event->imageUrl() }}" alt="Illustration de l'événement {{ $event->ba_title }}" class="h-48 w-full object-cover" />
                        @else
                            <div class="flex h-48 w-full items-center justify-center bg-slate-100 text-sm text-slate-400">Image non disponible</div>
                        @endif
                        <span class="absolute left-4 top-4 rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-slate-700">
                            {{ $event->ba_is_free ? 'Gratuit' : number_format((float) $event->ba_price, 2, ',', ' ') . ' €' }}
                        </span>
                    </div>
                    <div class="flex flex-1 flex-col gap-3 p-5">
                        <div>
                            <p class="text-xs uppercase tracking-wide text-slate-400">
                                {{ $event->ba_start_date?->format('d/m/Y H:i') }}
                            </p>
                            <h2 class="text-lg font-semibold text-slate-800">{{ $event->ba_title }}</h2>
                            <p class="text-sm text-slate-600">{{ $event->ba_place }}</p>
                        </div>
                        <div class="mt-auto flex items-center justify-between text-sm text-slate-600">
                            <span>{{ $event->category?->ba_name ?? 'Catégorie non renseignée' }}</span>
                            <span>{{ max(0, $event->ba_capacity - $event->registrations_count) }} places restantes</span>
                        </div>
                        <div>
                            <a
                                href="{{ route('events.show', $event) }}"
                                class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-indigo-200 hover:text-indigo-700"
                            >
                                Voir plus
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-10 text-center text-sm text-slate-500 md:col-span-2 xl:col-span-3">
                    Aucun événement ne correspond à vos critères.
                </div>
            @endforelse
        </div>

        <div class="flex justify-center">
            {{ $events->links() }}
        </div>
    </div>
</x-app-layout>
