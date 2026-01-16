<x-app-layout>
    <div class="space-y-10">
        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                <ul class="list-disc space-y-1 pl-4">
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="relative overflow-hidden rounded-[32px]">
            @if ($event->imageUrl())
                <img src="{{ $event->imageUrl() }}" alt="Illustration de l'événement {{ $event->ba_title }}" class="absolute inset-0 h-full w-full object-cover" />
            @else
                <div class="absolute inset-0 bg-gradient-to-r from-purple-700 via-slate-900 to-purple-900"></div>
            @endif
            <div class="absolute inset-0 bg-slate-900/60"></div>
            <div class="relative z-10 grid gap-8 px-8 py-12 text-white md:grid-cols-[1.2fr_0.8fr] md:px-12">
                <div class="space-y-4">
                    <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white/80">
                        ← Back
                    </a>
                    <h1 class="text-3xl font-semibold md:text-4xl">{{ $event->ba_title }}</h1>
                    <p class="text-lg text-white/80">{{ $event->ba_place }}</p>
                    <p class="max-w-xl text-sm text-white/75">
                        {{ $event->ba_description }}
                    </p>
                    <div class="inline-flex items-center gap-3 rounded-full bg-white/15 px-4 py-2 text-xs uppercase tracking-widest text-white/70">
                        {{ $event->ba_start_date?->format('M d, Y') }} · {{ $event->ba_start_date?->format('H:i') }} - {{ $event->ba_end_date?->format('H:i') }}
                    </div>
                </div>

                <div class="flex items-center justify-center">
                    <div class="w-full max-w-sm rounded-2xl bg-white/95 p-6 text-center text-slate-900 shadow-xl">
                        <h2 class="text-lg font-semibold">Book Event</h2>
                        <p class="mt-2 text-sm text-slate-500">Secure your seat in one click.</p>

                        <div class="mt-6 space-y-3">
                            @if (auth()->check())
                                @if ($isActive && ! $isFull && ! $isRegistered)
                                    <form method="POST" action="{{ route('events.register', $event) }}" class="space-y-3">
                                        @csrf
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('events.index') }}" class="flex-1 rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-500">
                                                Cancel
                                            </a>
                                            <x-primary-button type="submit" class="flex-1">Book now</x-primary-button>
                                        </div>
                                    </form>
                                @elseif ($isRegistered)
                                    <p class="text-sm text-slate-600">You are already registered for this event.</p>
                                @elseif (! $isActive)
                                    <p class="text-sm text-slate-600">Registrations are closed for this event.</p>
                                @else
                                    <p class="text-sm text-slate-600">This event is fully booked.</p>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="inline-flex w-full items-center justify-center rounded-full bg-purple-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-purple-500">
                                    Sign in to book
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-8 rounded-3xl bg-white p-8 shadow-sm md:grid-cols-[2fr_1fr]">
            <div>
                <h3 class="text-lg font-semibold text-slate-900">Description</h3>
                <p class="mt-3 text-sm text-slate-600">{{ $event->ba_description }}</p>
            </div>
            <div class="space-y-6 text-sm text-slate-600">
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-widest text-slate-400">Hours</h4>
                    <p class="mt-2 text-slate-700">Weekdays: {{ $event->ba_start_date?->format('H:i') }} - {{ $event->ba_end_date?->format('H:i') }}</p>
                    <p class="text-slate-700">Weekend: {{ $event->ba_start_date?->format('H:i') }} - {{ $event->ba_end_date?->format('H:i') }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-widest text-slate-400">Capacity</h4>
                    <p class="mt-2 text-slate-700">{{ $event->ba_capacity }} person</p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-widest text-slate-400">Availability</h4>
                    <p class="mt-2 text-slate-700">{{ $remainingSeats }} seats left</p>
                </div>
            </div>
        </section>

        <footer class="rounded-[28px] bg-[#1c1c72] px-6 py-10 text-white md:px-10">
            <div class="flex flex-col items-center gap-6 text-center">
                <h3 class="text-2xl font-semibold">Event Planner</h3>
                <form class="flex w-full max-w-md flex-col gap-3 sm:flex-row">
                    <input
                        type="email"
                        placeholder="Enter your mail"
                        class="w-full rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm text-white placeholder:text-white/60 focus:border-white focus:ring focus:ring-white/30"
                    />
                    <button
                        type="submit"
                        class="rounded-full bg-white px-5 py-2 text-sm font-semibold text-[#1c1c72]"
                    >
                        Subscribe
                    </button>
                </form>
                <div class="flex flex-wrap items-center justify-center gap-6 text-sm text-white/70">
                    <a href="{{ route('events.index') }}">Home</a>
                    <a href="{{ route('register') }}">Sign Up</a>
                    <a href="{{ route('login') }}">Sign In</a>
                </div>
                <div class="w-full border-t border-white/10 pt-4 text-xs text-white/50">
                    Non Copyrighted © 2025 Event Planner
                </div>
            </div>
        </footer>
    </div>
</x-app-layout>
