<x-guest-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-semibold">Connexion</h1>
            <p class="text-sm text-slate-500">Accédez à votre espace EventPlanner.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="ba_email" value="Email" />
                <x-text-input id="ba_email" name="ba_email" type="email" autocomplete="username" value="{{ old('ba_email') }}" required autofocus />
                <x-input-error :messages="$errors->get('ba_email')" />
            </div>

            <div>
                <x-input-label for="password" value="Mot de passe" />
                <x-text-input id="password" name="password" type="password" autocomplete="current-password" required />
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-indigo-600">
                    Se souvenir de moi
                </label>
                <a href="{{ route('register') }}" class="text-sm text-indigo-600 hover:text-indigo-500">Créer un compte</a>
            </div>

            <x-primary-button type="submit" class="w-full">Se connecter</x-primary-button>
        </form>
    </div>
</x-guest-layout>
