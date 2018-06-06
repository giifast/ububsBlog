<?php

namespace App\Http\Middleware;

use Ububs\Core\Component\Middleware\Kernel as KernelMiddleware;

class Kernel extends KernelMiddleware
{
    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    public $routeMiddleware = [
        'auth.admin' => \App\Http\Middleware\AuthLogin::class,
    ];
}
