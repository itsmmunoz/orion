<?php

declare(strict_types=1);

namespace Modules\MoonLaunch\MoonShine\Pages;

use Composer\InstalledVersions;
use Modules\MoonLaunch\Models\Role;
use Modules\MoonLaunch\Models\User;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Metrics\Wrapped\ValueMetric;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Text;
use Spatie\Permission\Models\Permission;

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
        return $this->title ?: __('moon-launch::ui.dashboard.dashboard');
    }

    private function version(string $pkg): string
    {
        return InstalledVersions::isInstalled($pkg)
            ? (InstalledVersions::getPrettyVersion($pkg) ?? '—')
            : '—';
    }

    private function metrics(): array
    {
        return [
            ValueMetric::make(__('moon-launch::ui.dashboard.admins'))
                ->value(fn (): int => User::count())
                ->columnSpan(4)
                ->icon('s.users'),

            ValueMetric::make(__('moon-launch::ui.dashboard.roles'))
                ->value(fn (): int => Role::count())
                ->columnSpan(4)
                ->icon('s.shield-check'),

            ValueMetric::make(__('moon-launch::ui.dashboard.permissions'))
                ->value(fn (): int => Permission::count())
                ->columnSpan(4)
                ->icon('s.key'),
        ];
    }

    private function systemMetrics(): array
    {
        return [
            ValueMetric::make('PHP')
                ->value(fn (): string => PHP_VERSION)
                ->columnSpan(3)
                ->icon('s.code-bracket'),

            ValueMetric::make('Laravel')
                ->value(fn (): string => $this->version('laravel/framework'))
                ->columnSpan(3)
                ->icon('s.cube'),

            ValueMetric::make(__('moon-launch::ui.dashboard.roles_permissions'))
                ->value(fn (): string => $this->version('sweet1s/moonshine-roles-permissions'))
                ->columnSpan(3)
                ->icon('s.shield-check'),

            ValueMetric::make('MoonShine')
                ->value(fn (): string => $this->version('moonshine/moonshine'))
                ->columnSpan(3)
                ->icon('s.sparkles'),
        ];
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        return [
            Box::make(__('moon-launch::ui.dashboard.overview'), [
                Grid::make($this->metrics()),
            ]),

            Box::make(__('moon-launch::ui.dashboard.latest_admins'), [
                TableBuilder::make(
                    [
                        Text::make(__('moon-launch::ui.resource.name'), 'name'),
                        Email::make(__('moon-launch::ui.resource.email'), 'email'),
                        Date::make(__('moon-launch::ui.resource.created_at'), 'created_at')->format('d/M/Y'),
                    ],
                    User::query()->latest()->limit(5)->get(),
                ),
            ]),

            Box::make(__('moon-launch::ui.dashboard.stack'), [
                Grid::make($this->systemMetrics()),
            ]),
        ];
    }
}
