<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Tymon\JWTAuth\JWTAuth;
use Closure;
class AdminMiddleware
{
    use ApiResponse;
    protected $auth;

    public function __construct(JWTAuth $jwt)
    {
        $this->auth = $jwt->user();
    }
    public function handle($request, Closure $next)
    {
        if ((int)$this->auth->role === 0)
        {
            return $this -> successResponseMessage(new \stdClass(), 401, 'User không có quyền');
        }
        $request->request->add(['user' => $this->auth]);
        return $next($request);
    }
}
