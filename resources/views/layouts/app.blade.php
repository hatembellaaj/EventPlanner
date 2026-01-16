<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EventPlanner</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-900">
    <div class="min-h-screen">
        <nav class="bg-white shadow">
            <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
                <div class="text-lg font-semibold">EventPlanner</div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-slate-600">{{ Auth::user()->ba_name ?? '' }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-primary-button type="submit">Se déconnecter</x-primary-button>
                    </form>
                </div>
            </div>
        </nav>

        <main class="max-w-6xl mx-auto px-6 py-10">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
