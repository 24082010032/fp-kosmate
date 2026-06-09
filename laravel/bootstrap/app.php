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
    ->withMiddleware(function (Middleware $middleware): void {
        // KITA MATIKAN ENKRIPSI COOKIE-NYA DI SINI, COK!
        $middleware->encryptCookies(except: [
            'kosmate_session',
            'cookie_user_kosmate',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();