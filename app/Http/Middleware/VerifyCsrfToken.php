<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];

    /**
     * @param $request
     * @param Closure $next
     * @return Response
     * @throws TokenMismatchException
     */
    public function handle($request, Closure $next): Response
    {
        if (
            $this->isReading($request) ||
            $this->runningUnitTests() ||
            $this->inExceptArray($request) ||
            $this->tokensMatch($request)
        ) {
            return $this->addCookieToResponse($request, $next($request));
        }
        throw new TokenMismatchException;
    }

    protected function runningUnitTests(): bool
    {
        return $this->app->runningInConsole() && $this->environmentTests();
    }

    public function environmentTests(): bool
    {
        return Config::get('app.env') === 'testing';
    }
}
