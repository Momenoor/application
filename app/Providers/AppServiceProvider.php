<?php

namespace App\Providers;

use Illuminate\Http\Request;
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
        //
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

        Schema::defaultStringLength(191);
    }
}
