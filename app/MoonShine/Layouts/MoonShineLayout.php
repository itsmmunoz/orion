<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\MoonShine\Pages\Dashboard;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\MenuManager\MenuItem;
use MoonShine\UI\Components\Layout\Favicon;
use MoonShine\UI\Components\Layout\Footer;
use MoonShine\UI\Components\Layout\Layout;

final class MoonShineLayout extends AppLayout
{
    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    // protected function getFaviconComponent(): Favicon
    // {
    //     return parent::getFaviconComponent()->customAssets([
    //         'apple-touch' => 'favicon_path',
    //         '32' => 'favicon_path',
    //         '16' => 'favicon_path',
    //         'safari-pinned-tab' => 'favicon_path',
    //         'web-manifest' => 'favicon_path',
    //     ]);
    // }

    protected function getFooterComponent(): Footer
    {
        return Footer::make()
            ->copyright(
                fn (): string => 'ORION'
            )
            ->menu($this->getFooterMenu());
    }

    protected function menu(): array
    {
        return [
            MenuItem::make(Dashboard::class)->icon('s.home'),
        ];
    }

    public function build(): Layout
    {
        return parent::build();
    }
}
