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

namespace Hachi\LaravelMutiTenancy\Providers\Tenants;

use Hachi\LaravelMutiTenancy\Contracts\CurrentWebsite;
use Hachi\LaravelMutiTenancy\Environment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class WebsiteProvider extends ServiceProvider
{
    public $defer = true;

    public function provides()
    {
        return [CurrentWebsite::class];
    }

    public function boot(Application $app)
    {
        $app->make(Environment::class);
    }
}
