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

namespace Hachi\LaravelMutiTenancy\Abstracts;

abstract class AbstractEvent
{
    public $reason;

    /**
     * @param string $reason
     * @return $this
     */
    public function setReason(string $reason)
    {
        $this->reason = $reason;

        return $this;
    }
}
