<?php

function getRequestGk()
{
    $rootDomain = config('tenancy.website.root-domain');
    if (!$rootDomain) {
        return null;
    }
    $host = request()->getHost();
    return trim(str_replace($rootDomain, '', $host), '.');
}

