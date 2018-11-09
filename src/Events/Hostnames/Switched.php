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

namespace Hachi\LaravelMutiTenancy\Events\hostnames;


use Hachi\LaravelMutiTenancy\Abstracts\HostnameEvent;
use Hachi\LaravelMutiTenancy\Contracts\Hostname;

class Switched extends HostnameEvent
{
    /**
     * @var Hostname
     */
    public $old;

    /**
     * @param Hostname $hostname
     * @return $this
     */
    public function setOld(Hostname $hostname)
    {
        $this->old = $hostname;

        return $this;
    }
}
