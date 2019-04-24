<?php
/**
 * Created by PhpStorm.
 * DateTime: 2018/11/5 15:58
 * @author: hachi.zzq <hachi.zzq@gmail.com>
 */

namespace Hachi\LaravelMutiTenancy\Jobs;

use Hachi\LaravelMutiTenancy\Contracts\Repositories\WebsiteRepository;
use Hachi\LaravelMutiTenancy\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class WebsiteIdentification
{
    /**
     * @param Request $request
     * @param WebsiteRepository $websiteRepository
     * @return null
     */
    public function handle(Request $request, WebsiteRepository $websiteRepository)
    {
        $gk = Helper::getRequestGk();

        if (!$gk) {
            return null;
        }

        $website = $websiteRepository->findByGk($gk);

        if (!$website) {
            throw new ModelNotFoundException(sprintf("gk: %s website not found", $gk));
        }

        return $website;
    }
}
