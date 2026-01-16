<x-guest-layout>
    <div class="flex flex-col gap-10 lg:flex-row lg:items-center">
        <img
            src="{{ asset('images/Login.png') }}"
            alt="Login illustration"
            class="w-full max-w-md rounded-2xl object-cover shadow-sm lg:order-first"
        />
        <div class="space-y-8">
            <div class="text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.4em] text-slate-300">Event Planner</p>
                <h1 class="mt-3 text-3xl font-semibold text-slate-900">Sign In to Event Planner</h1>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="ba_email" value="Your Email" class="text-xs uppercase tracking-[0.2em] text-slate-400" />
                    <x-text-input id="ba_email" name="ba_email" type="email" autocomplete="username" value="{{ old('ba_email') }}" required autofocus placeholder="Enter your mail" />
                    <x-input-error :messages="$errors->get('ba_email')" />
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <x-input-label for="password" value="Password" class="text-xs uppercase tracking-[0.2em] text-slate-400" />
                        <span class="text-xs font-medium text-slate-400">Forgot your password?</span>
                    </div>
                    <x-text-input id="password" name="password" type="password" autocomplete="current-password" required placeholder="Enter your password" />
                    <x-input-error :messages="$errors->get('password')" />
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-slate-500">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-indigo-600">
                        Se souvenir de moi
                    </label>
                    <a href="{{ route('register') }}" class="text-sm font-semibold text-purple-600 hover:text-purple-500">Create account</a>
                </div>

                <x-primary-button type="submit" class="w-full py-3">Sign In</x-primary-button>
            </form>
        </div>
    </div>
</x-guest-layout>
