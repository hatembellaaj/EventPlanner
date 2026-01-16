<x-app-layout>
    <div class="space-y-6">
        <div class="bg-white shadow rounded-2xl p-6">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-800">Mes inscriptions</h1>
                    <p class="text-sm text-slate-500">Retrouvez les événements auxquels vous êtes inscrit.</p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                <ul class="list-disc space-y-1 pl-4">
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($events as $event)
                @php
                    $statusLabel = $event->ba_status === 'active' ? 'Actif' : 'Inactif';
                    $statusClasses = $event->ba_status === 'active' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600';
                    $canUnregister = ! $event->ba_start_date?->isPast();
                @endphp
                <div class="flex h-full flex-col rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <p class="text-xs uppercase tracking-wide text-slate-400">
                            {{ $event->ba_start_date?->format('d/m/Y H:i') }}
                        </p>
                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses }}">{{ $statusLabel }}</span>
                    </div>
                    <h2 class="mt-3 text-lg font-semibold text-slate-800">{{ $event->ba_title }}</h2>
                    <p class="text-sm text-slate-600">{{ $event->ba_place }}</p>
                    <p class="mt-2 text-xs uppercase tracking-wide text-slate-400">Catégorie</p>
                    <p class="text-sm text-slate-600">{{ $event->category?->ba_name ?? 'Catégorie non renseignée' }}</p>
                    <div class="mt-auto flex flex-wrap gap-3 pt-5">
                        <a
                            href="{{ route('events.show', $event) }}"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-indigo-200 hover:text-indigo-700"
                        >
                            Voir l'événement
                        </a>
                        @if ($canUnregister)
                            <form method="POST" action="{{ route('events.unregister', $event) }}">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="inline-flex items-center justify-center rounded-xl border border-rose-200 px-4 py-2 text-sm font-semibold text-rose-600 transition hover:border-rose-300 hover:text-rose-700"
                                >
                                    Se désinscrire
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-10 text-center text-sm text-slate-500 md:col-span-2 xl:col-span-3">
                    Vous n'êtes inscrit à aucun événement pour le moment.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
