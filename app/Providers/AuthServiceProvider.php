<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\{Gate};

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

        Gate::define('status', function (User $user) {
            return true;
        });

        Gate::define(('store-task'), function (User $user) {
            return true;
        });

        Gate::define(('update-task'), function (User $user) {
            return true;
        });

        Gate::define(('delete-task'), function (User $user, Task $task) {
            return $user->id === $task->createdBy->id;
        });
    }
}
