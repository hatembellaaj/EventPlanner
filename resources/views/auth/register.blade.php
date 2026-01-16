<x-guest-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-semibold">Créer un compte</h1>
            <p class="text-sm text-slate-500">Rejoignez EventPlanner en quelques secondes.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="ba_name" value="Nom" />
                <x-text-input id="ba_name" name="ba_name" type="text" autocomplete="name" value="{{ old('ba_name') }}" required autofocus />
                <x-input-error :messages="$errors->get('ba_name')" />
            </div>

            <div>
                <x-input-label for="ba_email" value="Email" />
                <x-text-input id="ba_email" name="ba_email" type="email" autocomplete="username" value="{{ old('ba_email') }}" required />
                <x-input-error :messages="$errors->get('ba_email')" />
            </div>

            <div>
                <x-input-label for="ba_password" value="Mot de passe" />
                <x-text-input id="ba_password" name="ba_password" type="password" autocomplete="new-password" required />
                <x-input-error :messages="$errors->get('ba_password')" />
            </div>

            <div>
                <x-input-label for="ba_password_confirmation" value="Confirmer le mot de passe" />
                <x-text-input id="ba_password_confirmation" name="ba_password_confirmation" type="password" autocomplete="new-password" required />
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-500">Déjà inscrit ?</a>
            </div>

            <x-primary-button type="submit" class="w-full">Créer mon compte</x-primary-button>
        </form>
    </div>
</x-guest-layout>
