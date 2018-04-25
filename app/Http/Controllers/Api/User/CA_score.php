<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Teams\Scores;
use App\Model\Teams\Athletes;
use Validator, Storage;
use App\Http\Controllers\Api\baseRestController;

class CA_score extends Controller
{
  use baseRestController;
  public function __construct()
  {
    $this->middleware('jwt');
  }

  public function index()
  {
    return response()
      ->json([
        'status' => true,
        'data' => Scores::all(),
        'message' => 'Success'
      ],200);
  }

  public function create()
  {
    return response()
      ->json([
        'form' => Scores::initialize(),
        'option' => []
      ],200);
  }

  public function store(Request $request)
  {
    //validation
    $roles = [];
    foreach (Scores::formValidation() as $key => $value) {
      if(isset($request[$key]) && !empty($request[$key])){
        $roles[$key] = $value;
      }
    }

    $validator = Validator::make($request->all(), $roles);

    if($validator->fails())
    {
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => $validator->errors()->first()
      ], 200);
    }
    // Insert Scores
    $score = Scores::create($request->all());

    // Return
    return response()->json([
      'status'=> true,
      'data' => null,
      'message' => "Add score successfully!"
    ], 200);
  }

  public function show($id)
  {
    // Return
    try {
      $score = Scores::findOrFail($id);
    } catch (\Exception $e) {
      return response()->json([
        'status'=> TRUE,
        'data' => null,
        'message' => "Score with id " . $id ." does not exist."
      ], 200);
    }
    return response()->json([
      'status'=> TRUE,
      'data' => [
        'score' => $score
      ],
      'message' => "Your score."
    ], 200);

  }

  public function edit($id)
  {
    // Return
    return response()->json([
      'status'=> TRUE,
      'data' => [
        'form' => Scores::initialize()
      ],
      'message' => "Edit your score."
    ], 200);
  }

  public function update(Request $request, $id)
  {
    //validation
    $roles = [];
    foreach (Scores::formValidation() as $key => $value) {
      if(isset($request[$key]) && !empty($request[$key])){
        $roles[$key] = $value;
      }
    }

    $validator = Validator::make($request->all(), $roles);

    if($validator->fails())
    {
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => $validator->errors()->first()
      ], 200);
    }

    try {
      // Update Data
      $score = Scores::findOrFail($id);
      $score->update($request->all());
      // Return
      return response()->json([
        'status'=> true,
        'data' => Scores::findOrFail($id),
        'message' => "Update score successfully!"
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => $e
      ], 200);
    }

  }

  public function input(Request $request)
  {
    $score = substr($request->score_id, 0, -1);
    $score = explode(',',$score);
    $value = substr($request->values, 0, -1);
    $value = explode(',',$value);

    try {
      // Update Data
      for ($i=0; $i < sizeof($score) ; $i++) {
        $update = Scores::findOrFail($score[$i]);
        $update->value = $value[$i];
        $update->save();
      }
      // Update status done to athlete
      $athlete = Athletes::findOrFail($request->athlete_id);
      $athlete->scoring_status = "done";
      $athlete->save();

      // Return
      return response()->json([
        'status'=> true,
        'data' => null,
        'message' => "Update score successfully!"
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => $e
      ], 200);
    }

  }

  public function destroy($id)
  {
    try {
      $score = Scores::findOrFail($id);
      $score->delete();
      return response()->json([
        'status'=> true,
        'data' => null,
        'message' => "Delete score successfully!"
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => "Score with id " . $id." does not exist."
      ], 200);
    }
  }
}
