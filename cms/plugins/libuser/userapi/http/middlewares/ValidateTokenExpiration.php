<?php namespace LibUser\UserApi\Http\Middlewares;

use Closure;
use LibUser\UserApi\Http\Middlewares\Authenticate as AuthenticateBase;
use Exception;

class ValidateTokenExpiration extends AuthenticateBase
{
    public function handle($request, Closure $next)
    {
        try {
            $this->authenticate($request);
        } catch (Exception $exception) {
            if ($exception->getMessage() == 'Token has expired') {
                return response()->json([
                    'error' => 'Token has expired',
                    'status' => 401,
                ], 401);
            }
        }

        return $next($request);
    }
}
