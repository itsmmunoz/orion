<?php

declare(strict_types=1);

namespace App\Modules\MoonLaunch\Providers;

use App\Modules\MoonLaunch\Console\Commands\LaunchInstall;
use App\Modules\MoonLaunch\Console\Commands\LaunchPermissions;
use App\Modules\MoonLaunch\MoonShine\Resources\Admin\AdminResource;
use App\Modules\MoonLaunch\MoonShine\Resources\Role\RoleResource;
use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Contracts\MenuManager\MenuManagerContract;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;
use Sweet1s\MoonshineRBAC\Components\MenuRBAC;

class MoonLaunchServiceProvider extends ServiceProvider
{
    public function boot(CoreContract $core, MenuManagerContract $menu): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'moon-launch');
        $this->loadJsonTranslationsFrom(__DIR__.'/../resources/lang');

        if ($this->app->runningInConsole()) {
            $this->commands([
                LaunchInstall::class,
                LaunchPermissions::class,
            ]);
        }

        $core->resources([
            AdminResource::class,
            RoleResource::class,
        ]);

        $menu->add(
            MenuRBAC::menu(
                MenuGroup::make('system', [
                    MenuItem::make(AdminResource::class, 'admins_title')
                        ->translatable('moon-launch::ui.resource'),
                    MenuItem::make(RoleResource::class, 'roles')
                        ->translatable('moon-launch::ui.resource'),
                ])
                    ->translatable('moonshine::ui.resource')
                    ->icon('m.cube')
            )
        );
    }
}
