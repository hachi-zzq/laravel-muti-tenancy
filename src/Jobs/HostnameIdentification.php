<?php
/**
 * Created by PhpStorm.
 * DateTime: 2018/11/5 15:58
 * @author: hachi.zzq <hachi.zzq@gmail.com>
 */

namespace Hachi\LaravelMutiTenancy\Jobs;

use Hachi\LaravelMutiTenancy\Contracts\Repositories\HostnameRepository;
use Illuminate\Http\Request;

class HostnameIdentification
{
    /**
     * @param Request $request
     * @param HostnameRepository $hostnameRepository
     * @return \Hachi\LaravelMutiTenancy\Contracts\Hostname|null|string
     */
    public function handle(Request $request, HostnameRepository $hostnameRepository)
    {
        $hostname = $request->getHost();
        
        if ($hostname) {
            $hostname = $hostnameRepository->findByHostname($hostname);
        }

        if (!$hostname) {
            $hostname = $hostnameRepository->getDefault();
        }

        return $hostname;
    }
}
