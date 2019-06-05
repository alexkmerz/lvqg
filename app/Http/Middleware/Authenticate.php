<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\Log;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = explode(' ', $request->header('Authorization'))[1];

        if(!$token) {
            return response()->json([
                'status' => 401,
                'error' => 'Token required.'
            ], 401);
        }

        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);

        } catch(ExpiredException $e) {
            return response()->json([
                'error' => 'Provided token is expired.'
            ], 400);

        } catch(Exception $e) {
            return response()->json([
                'error' => 'An error while decoding token.',
                'e' => $e->getMessage()
            ], 400);
        }

        $user = User::find($credentials->sub);

        if(!empty($user)){
            $request->auth = $user;
        }else{
            return response()->json([
                'error' => 'Provided token is invalid.'
            ], 400);
        }

        return $next($request);
    }
}
