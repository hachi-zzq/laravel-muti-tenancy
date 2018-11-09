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

namespace Hachi\LaravelMutiTenancy\Contracts\Repositories;

use Hachi\LaravelMutiTenancy\Contracts\Website;
use Illuminate\Database\Eloquent\Builder;

interface WebsiteRepository
{
    /**
     * @param string $uuid
     * @return Website|null
     */
    public function findByUuid(string $uuid);

    /**
     * @param string $id
     * @return Website|null
     */
    public function findById(string $id);
    /**
     * @param Website $website
     * @return Website
     */
    public function create(Website &$website): Website;
    /**
     * @param Website $website
     * @return Website
     */
    public function update(Website &$website): Website;
    /**
     * @param Website $website
     * @param bool $hard
     * @return Website
     */
    public function delete(Website &$website, $hard = false): Website;

    /**
     * @warn Only use for querying.
     * @return Builder
     */
    public function query(): Builder;
}
