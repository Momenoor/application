<?php

namespace App\Providers;

use App\Services\ClaimCollectionStatus;
use App\Services\Money;
use App\Services\Permission;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use PDO;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Money::class, function () {
            return new Money();
        });

        $this->app->bind(Permission::class, function () {
            return new Permission();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        /** Add request function to check if given value is email.
         *
         *   @param string|null
         *
         *   @return boolean
         */

        if (!Request::hasMacro('isEmail')) {
            Request::macro('isEmail', function ($value) {
                $result = filter_var($value, FILTER_VALIDATE_EMAIL);

                if (is_bool($result)) {
                    return $result;
                }

                if (is_string($result)) {
                    return true;
                }

                return false;
            });
        }

        if (!Request::hasMacro('baseRouteName')) {
            Request::macro('baseRouteName', function () {

                $routeName = request()->route()->getName();

                if (\Str::of($routeName)->contains('.')) {
                    return \Str::of($routeName)->explode('.')->first();
                }

                return;
            });
        }

        Paginator::useBootstrap();

        Schema::defaultStringLength(191);
    }
}
