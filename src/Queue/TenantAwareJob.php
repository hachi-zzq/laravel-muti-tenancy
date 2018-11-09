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

use Hachi\LaravelMutiTenancy\Contracts\Hostname;
use Hachi\LaravelMutiTenancy\Contracts\Repositories\HostnameRepository;
use Hachi\LaravelMutiTenancy\Environment;
use Illuminate\Queue\SerializesModels;

trait TenantAwareJob
{
    /**
     * @var int The hostname ID of the previously active tenant.
     */
    protected $hostname_id;

    use SerializesModels {
        __sleep as serializedSleep;
        __wakeup as serializedWakeup;
    }

    public function __sleep()
    {
        /** @var Environment $environment */
        $environment = app(Environment::class);

        $hostname = $environment->hostname();

        if ($hostname && !$this->hostname_id) {
            $this->hostname_id = $hostname->id;
        }

        $attributes = $this->serializedSleep();

        return $attributes;
    }

    public function __wakeup()
    {
        if (isset($this->hostname_id)) {

            /** @var Environment $environment */
            $environment = app(Environment::class);

            $hostname = app(HostnameRepository::class)->query()->where('id',$this->hostname_id)->first();
            if($hostname){
                $environment->hostname($hostname);
            }
        }

        $this->serializedWakeup();
    }

    /**
     * Manually override the hostname to be used.
     *
     * @param Hostname|int $hostname
     * @return $this
     */
    public function onHostname($hostname)
    {
        $this->hostname_id = $hostname instanceof Hostname ? $hostname->id : $hostname;

        return $this;
    }
}
