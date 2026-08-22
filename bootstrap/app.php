<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Trust the reverse proxy/load balancer in front of the app so Laravel
        // reads X-Forwarded-Proto correctly and knows the real request is HTTPS.
        // Without this, session cookies flip between secure/non-secure across
        // requests behind SSL-terminating proxies, invalidating the CSRF token (419).
        $middleware->trustProxies(
            at: '*',
            headers: Request::HEADER_X_FORWARDED_FOR |
                Request::HEADER_X_FORWARDED_HOST |
                Request::HEADER_X_FORWARDED_PORT |
                Request::HEADER_X_FORWARDED_PROTO |
                Request::HEADER_X_FORWARDED_AWS_ELB,
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // A CSRF/session mismatch (419) most often hits the login form (stale
        // tab, expired session, cached page). Send the user back to a fresh
        // login form with a clear message instead of Laravel's blank 419 page.
        $exceptions->render(function (TokenMismatchException $e, Request $request) {
            return redirect()->route('login')
                ->with('status', 'Phiên làm việc đã hết hạn, vui lòng đăng nhập lại.');
        });
    })->create();
