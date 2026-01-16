<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ba_name' => ['required', 'string', 'max:255'],
            'ba_email' => ['required', 'string', 'email', 'max:255', 'unique:ba_users,ba_email'],
            'ba_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'ba_name' => $validated['ba_name'],
            'ba_email' => $validated['ba_email'],
            'ba_password' => Hash::make($validated['ba_password']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
