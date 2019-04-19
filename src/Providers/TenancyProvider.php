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
use Hachi\LaravelMutiTenancy\Contracts\Customer as CustomerContract;
use Hachi\LaravelMutiTenancy\Contracts\Hostname as HostnameContract;

class TenancyProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config.php',
            'tenancy'
        );

        $this->registerModels();

        $this->registerRepositories();

        $this->registerProviders();
    }


    public function boot()
    {

    }

//    public function provides()
//    {
//        return [Environment::class];
//    }

    protected function registerModels()
    {
        $config = $this->app['config']['tenancy.models'];

        $this->app->bind(CustomerContract::class, $config['customer']);
        $this->app->bind(HostnameContract::class, $config['hostname']);
        $this->app->bind(WebsiteContract::class, $config['website']);

//        forward_static_call([$config['hostname'], 'observe'], FlushHostnameCache::class);
    }

    protected function registerRepositories()
    {
        $this->app->singleton(
            Contracts\Repositories\HostnameRepository::class,
            Repositories\HostnameRepository::class
        );
        $this->app->singleton(
            Contracts\Repositories\WebsiteRepository::class,
            Repositories\WebsiteRepository::class
        );
        $this->app->singleton(
            Contracts\Repositories\CustomerRepository::class,
            Repositories\CustomerRepository::class
        );
    }

    protected function registerProviders()
    {
//        $this->app->register(Providers\ConfigurationProvider::class);
//        $this->app->register(Providers\PasswordProvider::class);
//        $this->app->register(Providers\ConnectionProvider::class);
//        $this->app->register(Providers\UuidProvider::class);
//        $this->app->register(Providers\BusProvider::class);
//        $this->app->register(Providers\FilesystemProvider::class);
        $this->app->register(Providers\HostnameProvider::class);
//
//        // Register last.
//        $this->app->register(Providers\EventProvider::class);
    }

}
