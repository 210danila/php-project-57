<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('create-status', function (User $user, TaskStatus $taskStatus) {
            return true;
        });

        Gate::define('update-status', function (User $user, TaskStatus $taskStatus) {
            dump($user);
            return true;
        });

        Gate::define('delete-status', function (User $user, TaskStatus $taskStatus) {
            return true;
        });
    }
}
