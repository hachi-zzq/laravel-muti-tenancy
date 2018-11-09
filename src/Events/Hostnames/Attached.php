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

namespace Hachi\LaravelMutiTenancy\Events\Hostnames;

use Hachi\LaravelMutiTenancy\Abstracts\AbstractEvent;
use Hachi\LaravelMutiTenancy\Contracts\Hostname;
use Hachi\LaravelMutiTenancy\Contracts\Website;

class Attached extends AbstractEvent
{
    /**
     * @var Hostname
     */
    public $hostname;

    /**
     * @var Website
     */
    public $website;

    public function __construct(Hostname &$hostname, Website &$website)
    {
        $this->hostname = &$hostname;
        $this->website = &$website;
    }
}
