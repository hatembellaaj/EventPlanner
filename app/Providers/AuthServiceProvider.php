<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Registration;
use App\Policies\CategoryPolicy;
use App\Policies\EventPolicy;
use App\Policies\RegistrationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Event::class => EventPolicy::class,
        Category::class => CategoryPolicy::class,
        Registration::class => RegistrationPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin', fn ($user) => $user->isAdmin());
    }
}
