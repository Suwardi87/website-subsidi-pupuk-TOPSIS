<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PetaniMiddleware;
use App\Http\Middleware\PetugasDinasMiddleware;
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
            'role' => RoleMiddleware::class,  // Tambahkan baris ini
            'admin' => AdminMiddleware::class,
            'petugasDinas' => PetugasDinasMiddleware::class,
            'petani' => PetaniMiddleware::class,
        ]); // ✅ Hapus tanda kurung siku tambahan di sini
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
