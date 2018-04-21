<?php

namespace App\Http\Controllers\View\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\View\baseViewController;

class C_home extends Controller
{
  use baseViewController;
  public function index()
  {
    return view('user/front/f_home');
  }

  public function top_athlete()
  {
    return view('user/front/top_athlete');
  }
}
