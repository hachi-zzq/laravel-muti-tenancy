<?php

/*
 * This file is part of the hyn/multi-tenant package.
 *
 * (c) Daniël Klabbers <daniel@klabbers.email>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://laravel-tenancy.com
 * @see https://github.com/hyn/multi-tenant
 */

namespace Hachi\LaravelMutiTenancy\Validators;


use Hachi\LaravelMutiTenancy\Abstracts\Validator;

class WebsiteValidator extends Validator
{
    protected $create = [
        'customer_id' => ['integer', 'exists:%system%.customers,id'],
    ];
    protected $update = [
        'customer_id' => ['integer', 'exists:%system%.customers,id'],
    ];
}
