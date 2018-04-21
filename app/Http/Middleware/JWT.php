<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth, Auth;

class JWT
{
    public function handle($request, Closure $next)
    {
      $header = $request->header('Authorization');
      if (!empty($header)) {
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
