<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Lavary\Menu\Menu;

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
        (new Menu())->make('mainMenu', function ($menu) {
            $menu->add('<span class="menu-icon">
                <i class="bi bi-bar-chart fs-3"></i>
                </span>
                <span class="menu-title">' . __('app.matter') . '</span>
                <span class="menu-arrow"></span>', 'matter')->nickname('matter')->link->href('#')->attr(['class' => 'menu-link py-3']);
            $menu->matter->add('list', ['route' => 'matter.index'])->link->attr(['class' => 'menu-link py-3']);
            $menu->matter->add('create', ['route' => 'matter.create'])->link->attr(['class' => 'menu-link py-3']);
            $menu->add('<span class="menu-icon">
                <i class="bi bi-bar-chart fs-3"></i>
                </span>
                <span class="menu-title">' . __('app.user') . '</span>
                <span class="menu-arrow"></span>', 'matter')->nickname('user')->link->href('#')->attr(['class' => 'menu-link py-3']);
            $menu->user->add('list')->link->attr(['class' => 'menu-link py-3']);
            $menu->user->add('create')->link->attr(['class' => 'menu-link py-3']);
        });
        return $next($request);
    }
}
