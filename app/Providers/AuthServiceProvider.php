<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        Passport::routes();

        Passport::tokensCan( [
            'user'  => 'User Type',
            'admin' => 'Admin User Type',
        ] );

        Passport::setDefaultScope( [
            'user',
        ] );

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        // Gate::before( function ( $user, $ability ) {
        //     return $user->hasRole( 'superAdmin' ) ? true : null;
        // } );
    }
}
