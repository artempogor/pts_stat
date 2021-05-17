<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\Dashboard;
class PermissionServiceProvider extends ServiceProvider
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
    public function boot(Dashboard $dashboard)
    {
        $permissions = ItemPermission::group('Вкладки')
            ->addPermission('workers', 'Справочник работников')
            ->addPermission('maps', 'Карта ПТС');
        $dashboard->registerPermissions($permissions);
        $permissions = ItemPermission::group('Кнопки')
            ->addPermission('create_pts', 'Создать запись ПТС')
            ->addPermission('import_export', 'Импорт/экспорт')
            ->addPermission('create_workers', 'Создать запись работника');
        $dashboard->registerPermissions($permissions);


    }
}
