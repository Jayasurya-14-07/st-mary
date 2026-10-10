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
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
            \App\Http\Middleware\HandleInertiaRequests::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->respond(function ($response, Throwable $exception, \Illuminate\Http\Request $request) {
            $status = $response->getStatusCode();
            if (in_array($status, [404, 500, 503])) {
                $flashNews = \App\Models\FlashNews::where('status', 1)
                    ->orderBy('publish_date', 'desc')
                    ->get();

                return \Inertia\Inertia::render('Error', [
                    'status'    => $status,
                    'flashNews' => $flashNews,
                ])
                ->toResponse($request)
                ->setStatusCode($status);
            }

            return $response;
        });
    })->create();
