<?php
/**
 * Created by PhpStorm.
 * DateTime: 2018/11/5 15:39
 * @author: hachi.zzq <hachi.zzq@gmail.com>
 */

return [
    'models'  => [
        'website' => \Hachi\LaravelMutiTenancy\Models\Website::class
    ],
    'website' => [
        'root-domain'       => env("APP_DOMAIN", 'codingtest.com'),
        'filter-field-name' => env("TENANCY_FILTER_FIELD", 'website_id'),
    ],
    'db'      => [
        /**
         * 配置系统库的连接
         */
        'system-connection-name' => 'mysql',
        /**
         * 配置租户的连接
         */
        'tenant-connection-name' => 'mysql',
    ],
];