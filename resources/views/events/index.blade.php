<x-app-layout>
    <div class="space-y-12">
        <section class="relative overflow-hidden rounded-[32px] bg-slate-900 text-white">
            <img
                src="https://images.unsplash.com/photo-1503428593586-e225b39bddfe?auto=format&fit=crop&w=1400&q=80"
                alt="Audience at an event"
                class="absolute inset-0 h-full w-full object-cover opacity-70"
            />
            <div class="relative z-10 space-y-6 px-8 py-14 md:px-14">
                <div class="flex items-center justify-between text-sm text-white/80">
                    <span class="uppercase tracking-[0.3em]">Event Planner</span>
                    <div class="hidden items-center gap-3 sm:flex">
                        <span class="h-8 w-8 rounded-full bg-white/20"></span>
                        <span class="h-8 w-8 rounded-full bg-white/20"></span>
                    </div>
                </div>
                <h1 class="max-w-lg text-3xl font-semibold leading-tight md:text-4xl">
                    Made for those who do
                </h1>
                <p class="max-w-xl text-sm text-white/80">
                    Discover inspiring events, workshops, and conferences crafted for creators, builders, and curious minds.
                </p>
                <a
                    href="#upcoming-events"
                    class="inline-flex items-center justify-center rounded-full bg-purple-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-purple-500"
                >
                    Explore events
                </a>
            </div>
        </section>

        <section id="upcoming-events" class="space-y-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <h2 class="text-2xl font-semibold text-slate-900">
                    Upcoming <span class="text-purple-600">Events</span>
                </h2>
                <form method="GET" action="{{ route('events.index') }}" class="flex flex-wrap items-center gap-3">
                    <div class="relative">
                        <input
                            id="q"
                            name="q"
                            type="search"
                            value="{{ $filters['q'] }}"
                            placeholder="Search"
                            class="w-48 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-100"
                        />
                    </div>
                    <select
                        id="category"
                        name="category"
                        class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-100"
                    >
                        <option value="">Any category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->ba_id }}" @selected($filters['category'] == $category->ba_id)>
                                {{ $category->ba_name }}
                            </option>
                        @endforeach
                    </select>
                    <input
                        id="date_from"
                        name="date_from"
                        type="date"
                        value="{{ $filters['date_from'] }}"
                        class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-100"
                    />
                    <input
                        id="date_to"
                        name="date_to"
                        type="date"
                        value="{{ $filters['date_to'] }}"
                        class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-100"
                    />
                    <label for="free" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-600 shadow-sm">
                        <input
                            id="free"
                            name="free"
                            type="checkbox"
                            value="1"
                            class="h-4 w-4 rounded border-slate-300 text-purple-600 focus:ring-purple-200"
                            @checked($filters['free'] === '1')
                        />
                        Free
                    </label>
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-full bg-purple-600 px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-purple-500"
                    >
                        Apply
                    </button>
                </form>
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($events as $event)
                    <div class="flex h-full flex-col overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm">
                        <div class="relative">
                            @if ($event->imageUrl())
                                <img src="{{ $event->imageUrl() }}" alt="Illustration de l'événement {{ $event->ba_title }}" class="h-44 w-full object-cover" />
                            @else
                                <div class="flex h-44 w-full items-center justify-center bg-slate-100 text-sm text-slate-400">Image non disponible</div>
                            @endif
                            <span class="absolute left-4 top-4 rounded-full bg-white px-3 py-1 text-xs font-semibold text-slate-700 shadow">
                                {{ $event->ba_is_free ? 'Free' : number_format((float) $event->ba_price, 2, ',', ' ') . ' €' }}
                            </span>
                        </div>
                        <div class="flex flex-1 flex-col gap-3 p-5">
                            <div>
                                <p class="text-xs uppercase tracking-wide text-slate-400">
                                    {{ $event->ba_start_date?->format('l, M d · H:i') }}
                                </p>
                                <h2 class="text-lg font-semibold text-slate-800">{{ $event->ba_title }}</h2>
                                <p class="text-sm text-slate-500">{{ $event->ba_place }}</p>
                            </div>
                            <div class="mt-auto flex items-center justify-between text-xs text-slate-500">
                                <span>{{ $event->category?->ba_name ?? 'Category' }}</span>
                                <span>{{ max(0, $event->ba_capacity - $event->registrations_count) }} seats left</span>
                            </div>
                            <div>
                                <a
                                    href="{{ route('events.show', $event) }}"
                                    class="inline-flex items-center justify-center rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-purple-200 hover:text-purple-600"
                                >
                                    View details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-10 text-center text-sm text-slate-500 md:col-span-2 xl:col-span-3">
                        Aucun événement ne correspond à vos critères.
                    </div>
                @endforelse
            </div>

            <div class="flex justify-center">
                {{ $events->links() }}
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
