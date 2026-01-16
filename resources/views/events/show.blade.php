<x-app-layout>
    <div class="bg-white shadow rounded-2xl p-8 space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold">{{ $event->ba_title }}</h1>
                <p class="text-sm text-slate-600">{{ $event->category?->ba_name ?? 'Catégorie non renseignée' }}</p>
            </div>
            <div class="text-sm text-slate-600">
                {{ $event->ba_start_date?->format('d/m/Y H:i') }} &rarr; {{ $event->ba_end_date?->format('d/m/Y H:i') }}
            </div>
        </div>

        @if ($event->imageUrl())
            <img src="{{ $event->imageUrl() }}" alt="Illustration de l'événement {{ $event->ba_title }}" class="h-72 w-full rounded-2xl object-cover" />
        @endif

        <div class="grid gap-6 md:grid-cols-3">
            <div class="space-y-1">
                <p class="text-xs uppercase tracking-wide text-slate-400">Lieu</p>
                <p class="text-sm text-slate-700">{{ $event->ba_place }}</p>
            </div>
            <div class="space-y-1">
                <p class="text-xs uppercase tracking-wide text-slate-400">Capacité</p>
                <p class="text-sm text-slate-700">{{ $event->ba_capacity }} places</p>
            </div>
            <div class="space-y-1">
                <p class="text-xs uppercase tracking-wide text-slate-400">Tarif</p>
                <p class="text-sm text-slate-700">{{ $event->ba_is_free ? 'Gratuit' : number_format((float) $event->ba_price, 2, ',', ' ') . ' €' }}</p>
            </div>
        </div>

        <div>
            <p class="text-xs uppercase tracking-wide text-slate-400">Description</p>
            <p class="mt-2 text-sm text-slate-700">{{ $event->ba_description }}</p>
        </div>

        <div>
            <form method="POST" action="{{ route('events.registrations.store', $event) }}">
                @csrf
                <x-primary-button type="submit">S'inscrire</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
