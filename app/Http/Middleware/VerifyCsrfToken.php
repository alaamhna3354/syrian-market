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
        '*users-inactive',
        '*users-active',
        'admin/service',
        '*getService',
        '*setServiceRate',
        'user/service',
        '*sort-payment-methods',
        '*add-fund',
        'success',
        'failed',
        'payment/*',
        '*keyGenerate*'
    ];
}
