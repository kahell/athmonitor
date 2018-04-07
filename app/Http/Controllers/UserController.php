<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\user\User;
use Validator;
use App\Support\FilterPaginateOrder;

class UserController extends Controller
{
    public function index()
    {
      return response()
        ->json([
          'model' => User::FilterPaginateOrder()
        ]);
    }
}
