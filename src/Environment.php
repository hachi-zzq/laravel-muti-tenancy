<?php namespace Hachi\LaravelMutiTenancy;

use Hachi\LaravelMutiTenancy\Contracts\CurrentHostname;
use Hachi\LaravelMutiTenancy\Contracts\Hostname;
use Hachi\LaravelMutiTenancy\Events\hostnames\Switched;
use Hachi\LaravelMutiTenancy\Jobs\HostnameIdentification;
use Hachi\LaravelMutiTenancy\Traits\DispatchesEvents;
use Hachi\LaravelMutiTenancy\Traits\DispatchesJobs;
use Illuminate\Contracts\Foundation\Application;
/**
 * Created by PhpStorm.
 * DateTime: 2018/11/5 15:37
 * @author: hachi.zzq <hachi.zzq@gmail.com>
 */

class Environment
{
    use DispatchesJobs,DispatchesEvents;

    /**
     * @var Application
     */
    protected $app;

    /**
     * Environment constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * 查询具体的 hostname;
     */
    public function identifyHostname()
    {
        $this->app->singleton(CurrentHostname::class, function () {
            $hostname = $this->dispatch(new HostnameIdentification());
            return $hostname;
        });
    }

    /**
     * Get or set the current hostname.
     *
     * @param Hostname|null $hostname
     * @return Hostname|null
     */
    public function hostname(Hostname $hostname = null)
    {
        if ($hostname !== null) {
            //if bind hostname ,then return auto
            $this->app->singleton(CurrentHostname::class, function () use ($hostname) {
                return $hostname;
            });
            
            $this->emitEvent(new Switched($hostname));

            return $hostname;
        }

        //if containter has hostname ,then return
        if($this->app->has(CurrentHostname::class) && $this->app->get(CurrentHostname::class)){
            return $this->app->get(CurrentHostname::class);
        }

        //else from request query hostname
        $this->identifyHostname();

        return $this->app->make(CurrentHostname::class);
    }

    /**
     * @return Website|bool
     */
    public function website()
    {
        /**
         * @var Hostname $hostname
         */
        $hostname = $this->hostname();

        return $hostname ? $hostname->website : null;
    }

    /**
     * @return Customer|null
     */
    public function customer()
    {
        /**
         * @var Hostname $hostname
         */
        $hostname = $this->hostname();

        return $hostname ? $hostname->customer : null;
    }

}