<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EventPlanner</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f2f2f2] text-slate-900" style="font-family: 'Poppins', sans-serif;">
    <div class="min-h-screen px-4 py-8">
        <div class="mx-auto w-full max-w-6xl rounded-[32px] bg-white shadow-xl">
            <nav class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 px-8 py-6">
                <div class="text-xl font-semibold text-slate-900">
                    Event <span class="text-purple-600">Planner</span>
                </div>
                <div class="flex flex-wrap items-center gap-4 text-sm">
                    <a href="{{ route('events.index') }}" class="font-medium text-slate-600 transition hover:text-purple-600">Events</a>
                    @auth
                        <a href="{{ route('registrations.index') }}" class="font-medium text-slate-600 transition hover:text-purple-600">
                            Registrations
                        </a>
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('admin.categories.index') }}" class="font-medium text-slate-600 transition hover:text-purple-600">
                                Categories
                            </a>
                            <a href="{{ route('admin.events.index') }}" class="font-medium text-slate-600 transition hover:text-purple-600">
                                Manage Events
                            </a>
                        @endif
                        <div class="flex items-center gap-3 rounded-full bg-slate-50 px-4 py-2">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-purple-100 text-sm font-semibold text-purple-600">
                                {{ strtoupper(substr(Auth::user()->ba_name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-800">{{ Auth::user()->ba_name }}</p>
                                <p class="text-xs text-slate-400">{{ Auth::user()->ba_email }}</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-primary-button type="submit">Logout</x-primary-button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full border border-purple-200 px-4 py-2 font-semibold text-purple-600 transition hover:border-purple-400">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="rounded-full bg-purple-600 px-5 py-2 font-semibold text-white shadow-sm transition hover:bg-purple-500">
                            Signup
                        </a>
                    @endauth
                </div>
            </nav>

            <main class="px-8 py-10">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
