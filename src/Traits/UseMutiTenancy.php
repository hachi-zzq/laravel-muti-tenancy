<?php
/**
 * Created by PhpStorm.
 * User: hachi
 * Date: 2018/11/7
 * Time: 15:05
 */

namespace Hachi\LaravelMutiTenancy\Traits;


use Hachi\LaravelMutiTenancy\Database\UseMutiTenancyScope;
use Hachi\LaravelMutiTenancy\Environment;

trait UseMutiTenancy
{
    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootUseMutiTenancy()
    {
        static::addGlobalScope(new UseMutiTenancyScope());
    }

    /**
     * overwrite newInstance with tenancy_id
     * @param array $attributes
     * @param bool $exists
     */
    public function newInstance($attributes = [], $exists = false)
    {
        $field = config()->get('tenancy.website.filter-field-name', 'tenancy_id');

        $website = app(Environment::class)->website();

        if($website && $this->isFillable($field)){

            $attributes[$field] = $website->id;
        }

        return parent::newInstance($attributes,$exists);
    }
}