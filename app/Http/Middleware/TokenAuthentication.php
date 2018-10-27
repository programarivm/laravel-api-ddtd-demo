<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class TokenAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authorization = $request->header('Authorization');
        $jwt = trim(preg_replace('/^(?:\s+)?Bearer\s/', '', $authorization));
        try {
            $decoded = JWT::decode($jwt, getenv('JWT_SECRET'), ['HS256']);
        } catch (\Exception $e) {
            throw new UnauthorizedHttpException('Unauthorized');
        }

        return $next($request);
    }
}
