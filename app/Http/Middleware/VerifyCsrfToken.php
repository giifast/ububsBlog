<?php
namespace App\Http\Middleware;

use FwSwoole\Middleware\Adapter\VerifyCsrfToken as VerifyCsrfTokenMiddleware;

class VerifyCsrfToken extends VerifyCsrfTokenMiddleware
{

	protected $except = [
        '/user', '/testPost'
    ];

}