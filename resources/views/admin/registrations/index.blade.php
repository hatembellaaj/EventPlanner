<x-app-layout>
    <div class="space-y-6">
        <div class="bg-white shadow rounded-2xl p-8 space-y-4">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-800">Inscriptions</h1>
                    <p class="text-sm text-slate-600">Suivez les inscriptions aux événements et filtrez par utilisateur ou événement.</p>
                </div>
            </div>

            <form method="GET" action="{{ route('admin.registrations.index') }}" class="grid gap-4 lg:grid-cols-3">
                <div>
                    <label for="event" class="text-sm font-medium text-slate-700">Événement</label>
                    <select
                        id="event"
                        name="event"
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        <option value="">Tous les événements</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->ba_id }}" @selected($filters['event'] == $event->ba_id)>
                                {{ $event->ba_title }} ({{ $event->ba_start_date?->format('d/m/Y') }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="q" class="text-sm font-medium text-slate-700">Utilisateur</label>
                    <input
                        id="q"
                        name="q"
                        type="search"
                        value="{{ $filters['q'] }}"
                        placeholder="Nom ou email"
                        class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
                <div class="flex items-end gap-3">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                    >
                        Filtrer
                    </button>
                    <a
                        href="{{ route('admin.registrations.index') }}"
                        class="text-sm font-medium text-slate-500 hover:text-slate-700"
                    >
                        Réinitialiser
                    </a>
                </div>
            </form>
        </div>

        @if ($errors->any())
            <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                <ul class="list-disc space-y-1 pl-4">
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50 text-left text-sm font-semibold text-slate-600">
                        <tr>
                            <th class="px-4 py-3">Utilisateur</th>
                            <th class="px-4 py-3">Événement</th>
                            <th class="px-4 py-3">Date d'inscription</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 text-sm">
                        @forelse ($registrations as $registration)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="font-medium text-slate-800">{{ $registration->user?->ba_name }}</div>
                                    <div class="text-xs text-slate-500">{{ $registration->user?->ba_email }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="font-medium text-slate-800">{{ $registration->event?->ba_title }}</div>
                                    <div class="text-xs text-slate-500">{{ $registration->event?->ba_start_date?->format('d/m/Y H:i') }}</div>
                                </td>
                                <td class="px-4 py-3 text-slate-600">
                                    {{ $registration->ba_created_at?->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-6 text-center text-slate-500">
                                    Aucune inscription ne correspond à vos filtres.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-4 py-4">
                {{ $registrations->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
