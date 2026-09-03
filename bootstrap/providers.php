<?php

use App\Modules\MoonLaunch\Providers\MoonLaunchServiceProvider;
use App\Providers\AppServiceProvider;
use App\Providers\MoonShineServiceProvider;

return [
    AppServiceProvider::class,
    MoonShineServiceProvider::class,
    MoonLaunchServiceProvider::class,
];
