<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class loginCheck
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
        if ($request->header('Authorization') === null) {
            return response()->json(['error' => '403'], 403);
        }
        $user = User::where('api_token', $request->header('Authorization'))->first();
        if (!$user) {
            return response()->json(['error' => '403'], 403);
        }
        return $next($request);
    }
}
