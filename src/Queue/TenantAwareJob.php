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

namespace Hachi\LaravelMutiTenancy\Queue;

use Hachi\LaravelMutiTenancy\Contracts\Repositories\WebsiteRepository;
use Hachi\LaravelMutiTenancy\Environment;
use Illuminate\Queue\SerializesModels;

trait TenantAwareJob
{
    protected $websiteId;

    use SerializesModels {
        __sleep as serializedSleep;
        __wakeup as serializedWakeup;
    }

    public function __sleep()
    {
        /** @var Environment $environment */
        $environment = app(Environment::class);

        $website = $environment->website();

        if ($website && !$this->websiteId) {
            $this->websiteId = $website->id;
        }

        $attributes = $this->serializedSleep();

        return $attributes;
    }

    public function __wakeup()
    {
        if (isset($this->websiteId)) {

            /** @var Environment $environment */
            $environment = app(Environment::class);

            $website = app(WebsiteRepository::class)->query()->where('id',$this->websiteId)->first();
            if($website){
                $environment->website($website);
            }
        }

        $this->serializedWakeup();
    }

}
