<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\LaporSampah::class => \App\Policies\LaporSampahPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}

namespace App\Policies;

use App\Models\LaporSampah;
use App\Models\User;

class LaporSampahPolicy
{
    public function update(User $user, LaporSampah $laporan)
    {
        return $user->id === $laporan->user_id;
    }

    public function delete(User $user, LaporSampah $laporan)
    {
        return $user->role === 'admin';
    }
}
