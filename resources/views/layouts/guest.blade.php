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
    <div class="min-h-screen px-4 py-10">
        <div class="mx-auto flex w-full max-w-5xl overflow-hidden rounded-[28px] bg-white shadow-2xl">
            <div
                class="relative hidden w-5/12 flex-col justify-between bg-cover bg-center p-10 text-white lg:flex"
                style="background-image: url('{{ request()->routeIs('login') ? asset('login.png') : 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1000&q=80' }}')"
            >
                <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/50 to-black/70"></div>
                <div class="relative z-10 space-y-6">
                    <div class="text-xs uppercase tracking-[0.3em] text-white/70">Event Planner</div>
                    @if (request()->routeIs('login'))
                        <div class="space-y-3">
                            <h2 class="text-3xl font-semibold">Hello Friend</h2>
                            <p class="text-sm text-white/80">
                                To keep connected with us provide us with your information.
                            </p>
                        </div>
                    @else
                        <div class="space-y-3">
                            <h2 class="text-3xl font-semibold">Welcome back</h2>
                            <p class="text-sm text-white/80">
                                To keep connected with us provide us with your information.
                            </p>
                        </div>
                    @endif
                </div>
                <div class="relative z-10">
                    @if (request()->routeIs('login'))
                        <a
                            href="{{ route('register') }}"
                            class="inline-flex items-center justify-center rounded-full border border-white/70 px-6 py-2 text-sm font-semibold text-white transition hover:bg-white/10"
                        >
                            Signup
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center justify-center rounded-full border border-white/70 px-6 py-2 text-sm font-semibold text-white transition hover:bg-white/10"
                        >
                            Signin
                        </a>
                    @endif
                </div>
            </div>

            <div class="flex w-full flex-1 items-center justify-center px-6 py-12 lg:w-7/12 lg:px-12">
                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
