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

namespace Hachi\LaravelMutiTenancy\Models;

use Carbon\Carbon;
use Hachi\LaravelMutiTenancy\Abstracts\SystemModel;
use Hachi\LaravelMutiTenancy\Contracts\Hostname as HostnameContract;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $fqdn
 * @property string $redirect_to
 * @property bool $force_https
 * @property Carbon $under_maintenance_since
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property int $website_id
 * @property Website $website
 * @property int $customer_id
 * @property Customer $customer
 */
class Hostname extends SystemModel implements HostnameContract
{
    protected $dates = ['under_maintenance_since'];

    public function website(): BelongsTo
    {
        return $this->belongsTo(config('tenancy.models.website'));
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(config('tenancy.models.customer'));
    }
}
