<x-app-layout>
    <div class="space-y-6">
        <div class="bg-white shadow rounded-2xl p-8">
            <h1 class="text-2xl font-semibold">Bienvenue sur EventPlanner !</h1>
            <p class="mt-2 text-sm text-slate-600">
                Retrouvez vos événements, gérez vos inscriptions et découvrez les prochaines sorties à venir.
            </p>
        </div>

        <div class="grid gap-4 md:grid-cols-2">
            <a
                href="{{ route('events.index') }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-indigo-200 hover:shadow"
            >
                <p class="text-sm font-medium text-slate-500">Découvrir</p>
                <h2 class="mt-2 text-lg font-semibold text-slate-800 group-hover:text-indigo-600">
                    Voir tous les événements
                </h2>
                <p class="mt-2 text-sm text-slate-600">
                    Filtrez par date, lieu ou catégorie pour trouver l'événement qui vous correspond.
                </p>
            </a>

            <a
                href="{{ route('registrations.index') }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-indigo-200 hover:shadow"
            >
                <p class="text-sm font-medium text-slate-500">Suivi</p>
                <h2 class="mt-2 text-lg font-semibold text-slate-800 group-hover:text-indigo-600">
                    Gérer mes inscriptions
                </h2>
                <p class="mt-2 text-sm text-slate-600">
                    Consultez vos réservations et annulez facilement si vos plans changent.
                </p>
            </a>
        </div>

        <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-6 text-sm text-slate-600">
            Astuce : utilisez les filtres pour repérer rapidement les événements gratuits ou proches de chez vous.
        </div>
    </div>
</x-app-layout>
