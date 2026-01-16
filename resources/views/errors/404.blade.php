<x-app-layout>
    <div class="bg-white shadow rounded-2xl p-10 text-center space-y-4">
        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-600">
            <span class="text-2xl font-semibold">404</span>
        </div>
        <div>
            <h1 class="text-2xl font-semibold text-slate-800">Page introuvable</h1>
            <p class="mt-2 text-sm text-slate-600">La page demandée n'existe pas ou a été déplacée.</p>
        </div>
        <div class="flex justify-center">
            @auth
                <a href="{{ route('dashboard') }}" class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">
                    Retour au tableau de bord
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">
                    Se connecter
                </a>
            @endauth
        </div>
    </div>
</x-app-layout>
