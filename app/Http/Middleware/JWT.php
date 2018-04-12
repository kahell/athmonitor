<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class JWT
{
    public function handle($request, Closure $next)
    {
      if ($request->has('token')) {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
            return $next($request);
        } catch (JWTException $e) {
            return redirect()->route('/');
        }
      }else{
        return response()->json(['error' => 'Token Must Required'], 404);
      }
    }
}
