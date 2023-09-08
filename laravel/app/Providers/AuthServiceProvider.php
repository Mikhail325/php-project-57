<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Label;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\LabelPolicy;
use App\Policies\TaskPolicy;
use App\Policies\StatusPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        Label::class => LabelPolicy::class,
        Task::class => TaskPolicy::class,
        Status::class => StatusPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
