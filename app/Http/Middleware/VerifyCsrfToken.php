<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'fetch-pks',
        'create-pks',
        'destroy-pks',
        'fetch-tbs-prices',
        'create-tbs-price',
    ];
}
