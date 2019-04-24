<?php
/**
 * Created by PhpStorm.
 * DateTime: 2018/11/5 15:58
 * @author: hachi.zzq <hachi.zzq@gmail.com>
 */

namespace Hachi\LaravelMutiTenancy\Jobs;

use Hachi\LaravelMutiTenancy\Contracts\Repositories\WebsiteRepository;
use Hachi\LaravelMutiTenancy\Helper;
use Illuminate\Http\Request;

class WebsiteIdentification
{
    /**
     * @param Request $request
     * @param WebsiteRepository $websiteRepository
     * @return null
     */
    public function handle(WebsiteRepository $websiteRepository)
    {
        $gk = Helper::getRequestGk();

        if (!$gk) {
            return null;
        }

        return $websiteRepository->findByGk($gk);
    }
}
