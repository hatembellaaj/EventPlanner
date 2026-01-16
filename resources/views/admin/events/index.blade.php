<x-app-layout>
    <div class="bg-white shadow rounded-2xl p-8 space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold">Événements</h1>
                <p class="text-sm text-slate-600">Gérez les événements disponibles dans l'application.</p>
            </div>
            <a href="{{ route('admin.events.create') }}" class="inline-flex items-center">
                <x-primary-button>Nouvel événement</x-primary-button>
            </a>
        </div>

        @if (session('success'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50 text-left text-sm font-semibold text-slate-600">
                    <tr>
                        <th class="px-4 py-3">Titre</th>
                        <th class="px-4 py-3">Catégorie</th>
                        <th class="px-4 py-3">Dates</th>
                        <th class="px-4 py-3">Statut</th>
                        <th class="px-4 py-3 text-center">Capacité</th>
                        <th class="px-4 py-3 text-center">Places restantes</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-sm">
                    @forelse ($events as $event)
                        @php
                            $remaining = max(0, $event->ba_capacity - $event->registrations_count);
                        @endphp
                        <tr>
                            <td class="px-4 py-3 font-medium text-slate-800">{{ $event->ba_title }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $event->category?->ba_name ?? 'Non renseignée' }}</td>
                            <td class="px-4 py-3 text-slate-600">
                                <div>{{ $event->ba_start_date?->format('d/m/Y H:i') }}</div>
                                <div class="text-xs text-slate-500">{{ $event->ba_end_date?->format('d/m/Y H:i') }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $event->ba_status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $event->ba_status === 'active' ? 'Actif' : 'Archivé' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center text-slate-600">{{ $event->ba_capacity }}</td>
                            <td class="px-4 py-3 text-center font-semibold {{ $remaining > 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                {{ $remaining }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.events.show', $event) }}" class="text-slate-600 hover:text-slate-800">Voir</a>
                                    <a href="{{ route('admin.events.edit', $event) }}" class="text-indigo-600 hover:text-indigo-800">Modifier</a>
                                    <form method="POST" action="{{ route('admin.events.destroy', $event) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Supprimer cet événement ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-slate-500">
                                Aucun événement pour le moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $events->links() }}
        </div>
    </div>
</x-app-layout>
