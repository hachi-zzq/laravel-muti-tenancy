<?php namespace Hachi\LaravelMutiTenancy;

/**
 * Created by PhpStorm.
 * DateTime: 2018/11/5 15:37
 * @author: hachi.zzq <hachi.zzq@gmail.com>
 */
class IgnoreWebsite
{
    private $ignoreIgnoreWebsite = false;

    public function __construct($ignore = true)
    {
        $this->ignoreIgnoreWebsite = $ignore;
    }

    public function getIgnoreWebsite()
    {
        return $this->ignoreIgnoreWebsite;
    }
}