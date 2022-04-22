<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\Html;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;


class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Menu::macro('main', function () {
            return Menu::new()
                ->setWrapperTag('div')
                ->addClass('menu menu-rounded menu-column menu-title-gray-700 menu-icon-gray-400 menu-arrow-gray-400 menu-bullet-gray-400 menu-arrow-gray-400 menu-state-bg fw-bold')
                ->setAttribute('data-kt-menu', 'true')
                ->add(Html::raw('<a href="#" class="menu-link">
                <span class="menu-icon">
                    <i class="bi bi-bar-chart fs-3"></i>
                </span>
                <span class="menu-title">Example Link</span>
            </a>
                '));


        });
    }
}
