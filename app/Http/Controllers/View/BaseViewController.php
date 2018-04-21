<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

trait baseViewController {

  protected $data = [
    'title' => 'Minar Management',
    'parent_nav' => '',
    'child_nav' => ''
  ];

}
