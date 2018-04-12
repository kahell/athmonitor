<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    public function handle($request, Closure $next)
    {
        $domains = ['http://127.0.0.1:8000/'];

        if(isset($request->server()['HTTP_ORIGIN'])){
          $origin = $request->server()['HTTP_ORIGIN'];
          if(in_array($origin, $domains)){
            header('Access-Control-Allow-Origin: ' . $origin);
            header('Access-Control-Allow-Origin: Origin, Content-Type, Authorization');
          }
        }
        return $next($request);
    }
}
