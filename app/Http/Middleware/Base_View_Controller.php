<?php

namespace App\Http\Middleware;

use App\Model\user\User;
use Closure, Session, Route;

class Base_View_Controller
{

    public function handle($request, Closure $next)
    {
      $session = session()->all();
      $url = $request->url();
      $splitUrl = explode('/',$url);
      $array = ['login','register','reset'];

      if(!empty($session['remember_token'])){
        if(in_array($splitUrl[3],$array)){
          return redirect('users');
        }
        return $next($request);
      }else{
        return redirect('login');
      }


    }
}
