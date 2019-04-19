<?php
/**
 * Created by PhpStorm.
 * User: hachi
 * Date: 2018/11/7
 * Time: 15:13
 */

namespace Hachi\LaravelMutiTenancy\Database;

use Hachi\LaravelMutiTenancy\Contracts\CurrentHostname;
use Hachi\LaravelMutiTenancy\Environment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;

class UseMutiTenancyScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $field = config()->get('tenancy.website.filter-field-name', 'tenancy_id');

        $website = app(Environment::class)->website();

        $builder->where($field, $website ? $website->id : 0);
    }
}