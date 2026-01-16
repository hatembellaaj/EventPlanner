<x-app-layout>
    <div class="bg-white shadow rounded-2xl p-8 space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold">{{ $event->ba_title }}</h1>
                <p class="text-sm text-slate-600">Détails de l'événement.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.events.edit', $event) }}" class="inline-flex items-center">
                    <x-primary-button>Modifier</x-primary-button>
                </a>
                <a href="{{ route('admin.events.index') }}" class="text-sm text-slate-600 hover:text-slate-800">Retour</a>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <div class="space-y-4">
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400">Catégorie</p>
                    <p class="text-sm font-semibold text-slate-700">{{ $event->category?->ba_name ?? 'Non renseignée' }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400">Dates</p>
                    <p class="text-sm text-slate-700">Du {{ $event->ba_start_date?->format('d/m/Y H:i') }} au {{ $event->ba_end_date?->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400">Lieu</p>
                    <p class="text-sm text-slate-700">{{ $event->ba_place }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400">Statut</p>
                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $event->ba_status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                        {{ $event->ba_status === 'active' ? 'Actif' : 'Archivé' }}
                    </span>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400">Capacité</p>
                    <p class="text-sm text-slate-700">{{ $event->ba_capacity }} places</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400">Inscriptions</p>
                    <p class="text-sm text-slate-700">{{ $event->registrations_count }} inscrits</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400">Places restantes</p>
                    <p class="text-sm font-semibold text-emerald-600">{{ max(0, $event->ba_capacity - $event->registrations_count) }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400">Tarif</p>
                    <p class="text-sm text-slate-700">{{ $event->ba_is_free ? 'Gratuit' : number_format((float) $event->ba_price, 2, ',', ' ') . ' €' }}</p>
                </div>
            </div>
        </div>

        @if ($event->imageUrl())
            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400">Illustration</p>
                <img src="{{ $event->imageUrl() }}" alt="Illustration de l'événement {{ $event->ba_title }}" class="mt-2 h-64 w-full rounded-2xl object-cover" />
            </div>
        @endif

        <div>
            <p class="text-xs uppercase tracking-wide text-slate-400">Description</p>
            <p class="mt-2 text-sm text-slate-700">{{ $event->ba_description }}</p>
        </div>
    </div>
</x-app-layout>
