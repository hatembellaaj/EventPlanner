<x-app-layout>
    <div class="bg-white shadow rounded-2xl p-8 space-y-6">
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

        <div class="grid gap-6 md:grid-cols-5">
            <div class="space-y-1">
                <p class="text-xs uppercase tracking-wide text-slate-400">Lieu</p>
                <p class="text-sm text-slate-700">{{ $event->ba_place }}</p>
            </div>
            <div class="space-y-1">
                <p class="text-xs uppercase tracking-wide text-slate-400">Capacité</p>
                <p class="text-sm text-slate-700">{{ $event->ba_capacity }} places</p>
            </div>
            <div class="space-y-1">
                <p class="text-xs uppercase tracking-wide text-slate-400">Places restantes</p>
                <p class="text-sm text-slate-700">{{ $remainingSeats }} place{{ $remainingSeats > 1 ? 's' : '' }}</p>
            </div>
            <div class="space-y-1">
                <p class="text-xs uppercase tracking-wide text-slate-400">Tarif</p>
                <p class="text-sm text-slate-700">{{ $event->ba_is_free ? 'Gratuit' : number_format((float) $event->ba_price, 2, ',', ' ') . ' €' }}</p>
            </div>
            <div class="space-y-1">
                <p class="text-xs uppercase tracking-wide text-slate-400">Statut</p>
                <p class="text-sm font-medium {{ $isFull ? 'text-rose-600' : 'text-emerald-600' }}">
                    {{ $isFull ? 'Complet' : 'Places disponibles' }}
                </p>
            </div>
        </div>

        <div>
            <p class="text-xs uppercase tracking-wide text-slate-400">Description</p>
            <p class="mt-2 text-sm text-slate-700">{{ $event->ba_description }}</p>
        </div>

        <div>
            @if (auth()->check())
                @if ($isActive && ! $isFull && ! $isRegistered)
                    <form method="POST" action="{{ route('events.register', $event) }}">
                        @csrf
                        <x-primary-button type="submit">S'inscrire</x-primary-button>
                    </form>
                @elseif ($isRegistered)
                    <p class="text-sm text-slate-600">Vous êtes déjà inscrit à cet événement.</p>
                @elseif (! $isActive)
                    <p class="text-sm text-slate-600">Les inscriptions sont fermées pour cet événement.</p>
                @else
                    <p class="text-sm text-slate-600">Cet événement est complet.</p>
                @endif
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                    S'inscrire
                </a>
            @endif
        </div>
    </div>
</x-app-layout>
