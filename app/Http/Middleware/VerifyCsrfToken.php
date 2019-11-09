<?php

namespace App\Http\Middleware;

use Ububs\Core\Component\Middleware\Adapter\VerifyCsrfToken as VerifyCsrfTokenMiddleware;

class VerifyCsrfToken extends VerifyCsrfTokenMiddleware
{

    protected $except = [
        '/', '/tools', '/backend', '/download'
    ];
}
