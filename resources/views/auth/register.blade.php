<x-guest-layout>
    <div class="space-y-8">
        <div class="text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.4em] text-slate-300">Event Planner</p>
            <h1 class="mt-3 text-3xl font-semibold text-slate-900">Sign Up to Event Planner</h1>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="ba_name" value="Your Name" class="text-xs uppercase tracking-[0.2em] text-slate-400" />
                <x-text-input id="ba_name" name="ba_name" type="text" autocomplete="name" value="{{ old('ba_name') }}" required autofocus placeholder="Enter your name" />
                <x-input-error :messages="$errors->get('ba_name')" />
            </div>

            <div>
                <x-input-label for="ba_email" value="Your Email" class="text-xs uppercase tracking-[0.2em] text-slate-400" />
                <x-text-input id="ba_email" name="ba_email" type="email" autocomplete="username" value="{{ old('ba_email') }}" required placeholder="Enter your email" />
                <x-input-error :messages="$errors->get('ba_email')" />
            </div>

            <div>
                <x-input-label for="ba_password" value="Password" class="text-xs uppercase tracking-[0.2em] text-slate-400" />
                <x-text-input id="ba_password" name="ba_password" type="password" autocomplete="new-password" required placeholder="Enter your password" />
                <x-input-error :messages="$errors->get('ba_password')" />
            </div>

            <div>
                <x-input-label for="ba_password_confirmation" value="Confirm Password" class="text-xs uppercase tracking-[0.2em] text-slate-400" />
                <x-text-input id="ba_password_confirmation" name="ba_password_confirmation" type="password" autocomplete="new-password" required placeholder="Enter your password" />
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-purple-600 hover:text-purple-500">Already registered?</a>
            </div>

            <x-primary-button type="submit" class="w-full py-3">Sign Up</x-primary-button>
        </form>
    </div>
</x-guest-layout>
