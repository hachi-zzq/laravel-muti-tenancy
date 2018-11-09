<?php
/**
 * Created by PhpStorm.
 * DateTime: 2018/11/5 15:50
 * @author: hachi.zzq <hachi.zzq@gmail.com>
 */

namespace Hachi\LaravelMutiTenancy\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface Hostname
{

    public function website(): BelongsTo;

    public function customer(): BelongsTo;
}