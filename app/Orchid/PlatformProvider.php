<?php

namespace App\Orchid;

use Illuminate\Support\Facades\Auth;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemMenu;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Support\Color;
use App\Models\PTS;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return ItemMenu[]
     */
    public function registerMainMenu(): array
    {
        return [

            ItemMenu::label('ПТС')
                ->title('ПТС')
                ->slug('example-menu')
                ->icon('drawer')
                ->badge(function () {
                    return PTS::count();
                })
                ->withChildren(),

            ItemMenu::label('Справочник')
                ->route('pts.lists')
                ->place('example-menu')
                ->icon('bag'),

            ItemMenu::label('Статус')
                ->route('pts.status')
                ->place('example-menu')
                ->icon('power'),
                ItemMenu::label('Карта')
                    ->permission('maps')
                    ->place('example-menu')
                    ->icon('map')
                    ->route('pts.maps'),
            ItemMenu::label('Справочник работников')
                ->route('workers.lists')
                ->icon('user-follow'),



            ItemMenu::label('Chart tools')
                ->icon('bar-chart')
                ->route('platform.example.charts')
                ->title('Примеры:'),

        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            ItemMenu::label('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemMenu[]
     */
    public function registerSystemMenu(): array
    {
        return [
            ItemMenu::label(__('Права доступа'))
                ->icon('lock')
                ->slug('Auth')
                ->active('platform.systems.*')
                ->permission('platform.systems.index')
                ->sort(1000),

            ItemMenu::label(__('Пользователь'))
                ->place('Auth')
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->sort(1000)
                ->title(__('Все пользователи')),

            ItemMenu::label(__('Роли'))
                ->place('Auth')
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->sort(1000)
                ->title(__('Роль определяет набор задач, которые пользователь, назначенный этой роли, может выполнять.')),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('Systems'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }

    /**
     * @return string[]
     */
    public function registerSearchModels(): array
    {
        return [
            // ...Models
            // \App\Models\User::class
        ];
    }
}
