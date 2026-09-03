<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Modules\MoonLaunch\Models\Role;
use App\Modules\MoonLaunch\Models\User;
use Composer\InstalledVersions;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;

class Dashboard extends Page
{
    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle(),
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'Dashboard';
    }

    private function version(string $pkg): string
    {
        return InstalledVersions::isInstalled($pkg)
            ? (InstalledVersions::getPrettyVersion($pkg) ?? '—')
            : '—';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        return [
            Box::make([
                Grid::make([
                    ValueMetric::make('Admins')
                        ->value(fn (): int => User::count())
                        ->columnSpan(6)
                        ->icon('s.users'),

                    ValueMetric::make('Roles')
                        ->value(fn (): int => Role::count())
                        ->columnSpan(6)
                        ->icon('s.shield-check'),
                    ValueMetric::make('PHP')
                        ->value(fn (): string => PHP_VERSION)
                        ->columnSpan(3)
                        ->icon('s.code-bracket'),

                    ValueMetric::make('Laravel')
                        ->value(fn (): string => $this->version('laravel/framework'))
                        ->columnSpan(3)
                        ->icon('s.cube'),

                    ValueMetric::make('MoonShine')
                        ->value(fn (): string => $this->version('moonshine/moonshine'))
                        ->columnSpan(3)
                        ->icon('s.sparkles'),

                    ValueMetric::make('Roles & Permissions')
                        ->value(fn (): string => $this->version('sweet1s/moonshine-roles-permissions'))
                        ->columnSpan(3)
                        ->icon('s.shield-check'),
                ]),
            ]),
        ];
    }
}
