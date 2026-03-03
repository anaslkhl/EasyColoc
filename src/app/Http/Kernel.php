<?php

namespace App\Http;


use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Route middleware.
     */
    protected $routeMiddleware = [
        'auth' => \app\Http\Middleware\MemberMiddleware::class, // For now, any authenticated user
        'ensure.admin'  => \app\Http\Middleware\AdminMiddleware::class,
        'ensure.owner'  => \app\Http\Middleware\OwnerMiddleware::class,
        'ensure.member' => \app\Http\Middleware\MemberMiddleware::class,
    ];
}
