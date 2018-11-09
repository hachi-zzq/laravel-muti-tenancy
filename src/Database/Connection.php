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

namespace Hachi\LaravelMutiTenancy\Database;

use Illuminate\Contracts\Config\Repository as Config;

class Connection
{
    const DEFAULT_SYSTEM_NAME = 'system';
    const DEFAULT_TENANT_NAME = 'tenant';

    /**
     * @var Config
     */
    protected $config;

    /**
     * Connection constructor.
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function systemName(): string
    {
        return $this->config->get('tenancy.db.system-connection-name', static::DEFAULT_SYSTEM_NAME);
    }

    /**
     * @return string
     */
    public function tenantName(): string
    {
        return $this->config->get('tenancy.db.tenant-connection-name', static::DEFAULT_TENANT_NAME);
    }

}
