<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class AuthServiceProvider.
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy', ];

    /**
     * Register any application authentication / authorization services.
     *
     * @return void
     *
     * @internal param GateContract $gate
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
