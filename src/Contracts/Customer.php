<?php
/**
 * Created by PhpStorm.
 * DateTime: 2018/11/5 15:50
 * @author: hachi.zzq <hachi.zzq@gmail.com>
 */

namespace Hachi\LaravelMutiTenancy\Contracts;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface Customer
{
    public function websites(): HasMany;

    public function hostnames(): HasMany;
}