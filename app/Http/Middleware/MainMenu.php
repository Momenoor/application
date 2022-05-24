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
            $menu->add(__('app.matters'), '#')->data('icon', 'bi bi-bar-chart')
                ->data('permission', ['matter-view', 'matter-create'])
                ->nickname('matters');
            $menu->matters->add(__('app.matters_list'), ['route' => 'matter.index'])->data('permission', 'matter-view');
            $menu->matters->add(__('app.create_matter'), ['route' => 'matter.create']);

            $menu->add(__('app.matter-distributing'), ['route'=>'matter.distributing'])->data('icon', 'bi bi-bar-chart')
                ->data('permission', ['matter-distributing']);

            $menu->add(__('app.matter_types'), ['route' => 'type.index'])->data('icon', 'bi bi-bar-chart')
                ->data('permission', ['type-view']);

            $menu->add(__('app.vacations'), '#')->data('icon', 'bi bi-bar-chart')
                ->data('permission', ['vacation-view', 'vacation-create'])
                ->nickname('vacations');
            $menu->vacations->add(__('app.vacations-list'), ['route' => 'vacation.index'])->data('permission', 'vacation-view');
            $menu->vacations->add(__('app.create-public-holiday'), ['route' => ['vacation.create','type'=>'public_holiday']]);
            $menu->vacations->add(__('app.create-annual-leave'), ['route' => ['vacation.create','type'=>'annual_leave']]);

            $menu->add(__('app.experts'), '#')->data('icon', 'bi bi-bar-chart')
                ->data('permission', ['expert-view', 'expert-create'])
                ->nickname('experts');
            $menu->experts->add(__('app.experts-list'), ['route' => 'expert.index'])->data('permission', 'expert-view');
            $menu->experts->add(__('app.create-expert'), ['route' => 'expert.create']);

            $menu->add(__('app.courts'), '#')->data('icon', 'bi bi-bar-chart')
                ->data('permission', ['court-view', 'court-create'])
                ->nickname('courts');
            $menu->courts->add(__('app.courts-list'), ['route' => 'court.index'])->data('permission', 'court-view');
            $menu->courts->add(__('app.create-court'), ['route' => 'court.create']);

            $menu->add(__('app.users'), '#')->data('icon', 'bi bi-bar-chart')
                ->data('permission', ['user-view', 'user-create', 'permission-view', 'role-view',])
                ->nickname('users');
            $menu->users->add(__('app.users_list'), ['route' => 'user.index'])->data('permission', ['user-view']);
            $menu->users->add(__('app.create_user'), ['route' => 'user.create'])->data('permission', ['user-create']);
            $menu->users->add(__('app.user_permissions'), ['route' => 'permission.index'])->data('permission', ['permission-view']);
            $menu->users->add(__('app.user_roles'), ['route' => 'role.index'])->data('permission', ['role-view']);
        });

        return $next($request);
    }
}
