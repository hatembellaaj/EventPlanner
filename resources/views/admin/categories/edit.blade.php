<x-app-layout>
    <div class="bg-white shadow rounded-2xl p-8 space-y-6">
        <div>
            <h1 class="text-2xl font-semibold">Modifier la catégorie</h1>
            <p class="text-sm text-slate-600">Mettez à jour le nom de la catégorie.</p>
        </div>

        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="name" value="Nom de la catégorie" />
                <x-text-input id="name" name="name" type="text" class="mt-2 block w-full" value="{{ old('name', $category->ba_name) }}" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button type="submit">Mettre à jour</x-primary-button>
                <a href="{{ route('admin.categories.index') }}" class="text-sm text-slate-600 hover:text-slate-800">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
