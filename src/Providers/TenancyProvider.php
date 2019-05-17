<?php

/*
 * This file is part of the hyn/multi-tenant package.
 *
 * (c) Daniël Klabbers <daniel@klabbers.email>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://laravel-tenancy.com
 * @see https://github.com/hyn/multi-tenant
 */

namespace Hachi\LaravelMutiTenancy\Providers;

use Hachi\LaravelMutiTenancy\Contracts;
use Hachi\LaravelMutiTenancy\Repositories;
use Illuminate\Support\ServiceProvider;
use Hachi\LaravelMutiTenancy\Providers\Tenants as Providers;
use Hachi\LaravelMutiTenancy\Contracts\Website as WebsiteContract;

class TenancyProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerModels();

        $this->registerRepositories();

        $this->registerProviders();
    }


    protected function registerModels()
    {
        $config = $this->app['config']['tenancy.models'];
        $this->app->bind(WebsiteContract::class, $config['website']);
    }

    protected function registerRepositories()
    {
        $this->app->singleton(
            Contracts\Repositories\WebsiteRepository::class,
            Repositories\WebsiteRepository::class
        );
    }

    protected function registerProviders()
    {
        $this->app->register(Providers\WebsiteProvider::class);
        $this->app->register(Providers\BusProvider::class);
    }

}
