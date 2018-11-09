<?php

namespace Hachi\LaravelMutiTenancy\Traits;
use Illuminate\Contracts\Bus\Dispatcher;

trait DispatchesJobs
{
    /**
     * @param $command
     * @param null $handler
     * @return mixed
     */
    public function dispatch($command, $handler = null)
    {
        return app(Dispatcher::class)->dispatchNow($command, $handler);
    }
}
