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

namespace Hachi\LaravelMutiTenancy\Repositories;

use Hachi\LaravelMutiTenancy\Contracts\Repositories\WebsiteRepository as Contract;
use Hachi\LaravelMutiTenancy\Contracts\Website;
use Hachi\LaravelMutiTenancy\Traits\DispatchesEvents;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Database\Eloquent\Builder;
use Hachi\LaravelMutiTenancy\Events\Websites\Creating;
use Hachi\LaravelMutiTenancy\Events\Websites\Created;
use Hachi\LaravelMutiTenancy\Events\Websites\Updated;
use Hachi\LaravelMutiTenancy\Events\Websites\Updating;
use Hachi\LaravelMutiTenancy\Events\Websites\Deleted;
use Hachi\LaravelMutiTenancy\Events\Websites\Deleting;

class WebsiteRepository implements Contract
{
    use DispatchesEvents;
    /**
     * @var Website
     */
    protected $website;
    /**
     * @var Factory
     */
    protected $cache;

    /**
     * WebsiteRepository constructor.
     * @param Website $website
     * @param Factory $cache
     */
    public function __construct(Website $website, Factory $cache)
    {
        $this->website = $website;
        $this->cache = $cache;
    }

    /**
     * @param string $id
     * @return Website|null
     */
    public function findById(string $id)
    {
        return $this->query()->where('id', $id)->first();
    }

    /**
     * @param Website $website
     * @return Website
     */
    public function create(Website &$website): Website
    {
        if ($website->exists) {
            return $this->update($website);
        }

        $this->emitEvent(
            new Creating($website)
        );

        $website->save();

        $this->cache->forget("tenancy.website.{$website->id}");

        $this->emitEvent(
            new Created($website)
        );

        return $website;
    }

    /**
     * @param Website $website
     * @return Website
     */
    public function update(Website &$website): Website
    {
        if (!$website->exists) {
            return $this->create($website);
        }

        $this->emitEvent(
            new Updating($website)
        );

        $dirty = collect(array_keys($website->getDirty()))->mapWithKeys(function ($value, $key) use ($website) {
            return [ $value => $website->getOriginal($value) ];
        });

        $website->save();

        $this->cache->forget("tenancy.website.{$website->id}");

        if ($dirty->has('id')) {
            $this->cache->forget("tenancy.website.{$dirty->get('id')}");
        }

        $this->emitEvent(
            new Updated($website, $dirty->toArray())
        );

        return $website;
    }

    /**
     * @param Website $website
     * @param bool $hard
     * @return Website
     */
    public function delete(Website &$website, $hard = false): Website
    {
        $this->emitEvent(
            new Deleting($website)
        );

        $hard ? $website->forceDelete() : $website->delete();

        $this->cache->forget("tenancy.website.{$website->id}");

        $this->emitEvent(
            new Deleted($website)
        );

        return $website;
    }

    /**
     * @warn Only use for querying.
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->website->newQuery();
    }

    public function findByGk($gk)
    {
        return $this->query()->where('global_key', $gk)->first();
    }
}
