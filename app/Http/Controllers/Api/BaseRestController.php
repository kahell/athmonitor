<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;

trait baseRestController {

  public function displayToJSON($content) {
    return response()->json([
      'status'=> $content['status'],
      'data' => $content['data'],
      'message' => $content['message']
    ], $content['header']);
  }

  public function displayDataNotFound($message = 'data does not exists') {
    return response()->json([
      'status'=> FALSE,
      'data' => null,
      'message' => $message
    ], 200);
  }

  public function displayBadRequest($message = "Bad Header") {
    return response()->json([
      'status'=> FALSE,
      'data' => null,
      'message' => $message
    ], 401);
  }

}
