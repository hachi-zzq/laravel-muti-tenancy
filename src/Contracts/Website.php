<?php
/**
 * Created by PhpStorm.
 * DateTime: 2018/11/5 15:50
 * @author: hachi.zzq <hachi.zzq@gmail.com>
 */

namespace Hachi\LaravelMutiTenancy\Contracts;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface Website
{
    public function customer(): BelongsTo;

    public function hostnames(): HasMany;
}