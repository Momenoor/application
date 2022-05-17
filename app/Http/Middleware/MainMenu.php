<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MainMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        \Menu::make('mainMenu', function ($menu) {
            $menu->add(__('app.matters'), '#')->data('icon','bi bi-bar-chart')->nickname('matters');
            $menu->matters->add(__('app.matters_list'), ['route' => 'matter.index']);
            $menu->matters->add(__('app.create_matter'), ['route' => 'matter.create']);
        });

        return $next($request);
    }
}
