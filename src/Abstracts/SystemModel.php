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

use Illuminate\Database\Eloquent\Model;
use Hachi\LaravelMutiTenancy\Traits\UsesSystemConnection;

abstract class SystemModel extends AbstractModel
{
    use UsesSystemConnection;
}
