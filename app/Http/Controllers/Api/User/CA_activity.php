<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Teams\Activities;
use Validator, Storage;
use App\Http\Controllers\Api\baseRestController;

class CA_activity extends Controller
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
        'data' => Activities::all(),
        'message' => 'Success'
      ],200);
  }

  public function create()
  {
    return response()
      ->json([
        'form' => Activities::initialize(),
        'option' => []
      ],200);
  }

  public function store(Request $request)
  {
    //validation
    $roles = [];
    foreach (Activities::formValidation() as $key => $value) {
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
    // Insert Activities
    $activity = Activities::create($request->all());

    // Return
    return response()->json([
      'status'=> true,
      'data' => [
        'activity' => Activities::findOrFail($activity->id)
      ],
      'message' => "Add activity successfully!"
    ], 200);
  }

  public function show($id)
  {
    try {
      // Return
      return response()->json([
        'status'=> TRUE,
        'data' => [
          'activity' => Activities::findOrFail($id)
        ],
        'message' => "Your activity."
      ], 200);
    } catch (\Exception $e) {
      // Return
      return response()->json([
        'status'=> TRUE,
        'data' => null,
        'message' => "Activity with id " . $id . " does not exists."
      ], 200);
    }

  }

  public function edit($id)
  {
    // Return
    return response()->json([
      'status'=> TRUE,
      'data' => [
        'form' => Activities::initialize()
      ],
      'message' => "Edit your activity."
    ], 200);
  }

  public function update(Request $request, $id)
  {
    //validation
    $roles = [];
    foreach (Activities::formValidation() as $key => $value) {
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
      $activity = Activities::findOrFail($id);
      $activity->update($request->all());
      return response()->json([
        'status'=> true,
        'data' => Activities::findOrFail($id),
        'message' => "Update activity successfully!"
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
      $activity = Activities::findOrFail($id);
      $activity->delete();
      return response()->json([
        'status'=> true,
        'data' => null,
        'message' => "Delete activity successfully!"
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => "Activity with id " . $id . " does not exists."
      ], 200);
    }
  }
}
