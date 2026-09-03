<?php

namespace App\Modules\MoonLaunch\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait WithTrashedQuery
{
    /**
     * modifyItemQueryBuilder
     *
     * @param  mixed  $builder
     */
    protected function modifyItemQueryBuilder(Builder $builder): Builder
    {
        return $builder->withTrashed();
    }
}
