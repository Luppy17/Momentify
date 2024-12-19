<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
            'adminManager' => \App\Http\Middleware\IsAdminManager::class,
            'adminPhotographer' => \App\Http\Middleware\IsAdminPhotographer::class,
            'adminUser' => \App\Http\Middleware\IsAdminUser::class,
            'adminManagerPhotographer' => \App\Http\Middleware\IsAdminManagerPhotographer::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
