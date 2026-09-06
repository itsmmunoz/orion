<?php

use App\Providers\AppServiceProvider;
use App\Providers\MoonShineServiceProvider;
use Modules\MoonLaunch\Providers\MoonLaunchServiceProvider;

return [
    AppServiceProvider::class,
    MoonShineServiceProvider::class,
    MoonLaunchServiceProvider::class,
];
