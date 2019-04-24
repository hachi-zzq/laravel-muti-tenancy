<?php namespace Hachi\LaravelMutiTenancy;

use Hachi\LaravelMutiTenancy\Contracts\CurrentWebsite;
use Hachi\LaravelMutiTenancy\Contracts\Repositories\WebsiteRepository;
use Hachi\LaravelMutiTenancy\Contracts\Website;
use Hachi\LaravelMutiTenancy\Jobs\WebsiteIdentification;
use Hachi\LaravelMutiTenancy\Traits\DispatchesEvents;
use Hachi\LaravelMutiTenancy\Traits\DispatchesJobs;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Created by PhpStorm.
 * DateTime: 2018/11/5 15:37
 * @author: hachi.zzq <hachi.zzq@gmail.com>
 */
class Environment
{
    use DispatchesJobs, DispatchesEvents;

    /**
     * @var Application
     */
    protected $app;

    protected $websiteRepository;

    /**
     * Environment constructor.
     * @param Application $app
     */
    public function __construct(Application $app, WebsiteRepository $websiteRepository)
    {
        $this->app = $app;
        $this->websiteRepository = $websiteRepository;
    }


    public function identifyWebsite()
    {
        $this->app->singleton(CurrentWebsite::class, function () {
            return $this->dispatch(new WebsiteIdentification());
        });
    }

    public function website(Website $website = null)
    {
        if ($website !== null) {

            $this->app->singleton(CurrentWebsite::class, function () use ($website) {
                return $website;
            });


            return $website;
        }

        if ($this->app->has(CurrentWebsite::class) && $this->app->get(CurrentWebsite::class)) {
            return $this->app->get(CurrentWebsite::class);
        }

        $this->identifyWebsite();

        return $this->app->make(CurrentWebsite::class);
    }


    public function switchWebsiteByGk($gk)
    {
        $website = $this->websiteRepository->findByGk($gk);

        if (!$website) {
            throw new ModelNotFoundException(sprintf("gk: %s website not found", $gk));
        }

        return $this->website($website);
    }
}