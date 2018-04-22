<?php

namespace App\Http\Controllers\Api\Sports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Sports\Position_types;
use Validator, Storage;
use App\Http\Controllers\Api\baseRestController;

class CA_position_type extends Controller
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
        'data' => Position_types::all(),
        'message' => 'Success'
      ],200);
  }

  public function create()
  {
    return response()
      ->json([
        'form' => Position_types::initialize(),
        'option' => []
      ],200);
  }

  public function store(Request $request)
  {
    //validation
    $roles = [];
    foreach (Position_types::formValidation() as $key => $value) {
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
    // Insert Position_types
    $position = Position_types::create($request->all());

    // Return
    return response()->json([
      'status'=> true,
      'data' => null,
      'message' => "Add position type successfully!"
    ], 200);
  }

  public function show($id)
  {
    // Return
    try {
      $position = Position_types::findOrFail($id);
    } catch (\Exception $e) {
      return response()->json([
        'status'=> TRUE,
        'data' => null,
        'message' => "Position with id " . $id ." does not exist."
      ], 200);
    }
    return response()->json([
      'status'=> TRUE,
      'data' => [
        'position_type' => $position
      ],
      'message' => "Your position type."
    ], 200);

  }

  public function edit($id)
  {
    // Return
    return response()->json([
      'status'=> TRUE,
      'data' => [
        'form' => Position_types::initialize()
      ],
      'message' => "Edit your position type."
    ], 200);
  }

  public function update(Request $request, $id)
  {
    //validation
    $roles = [];
    foreach (Position_types::formValidation() as $key => $value) {
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
      $position = Position_types::findOrFail($id);
      $position->update($request->all());
      // Return
      return response()->json([
        'status'=> true,
        'data' => Position_types::findOrFail($id),
        'message' => "Update position type successfully!"
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
      $position = Position_types::findOrFail($id);
      $position->delete();
      return response()->json([
        'status'=> true,
        'data' => null,
        'message' => "Delete position type successfully!"
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => "Position with id " . $id." does not exist."
      ], 200);
    }
  }
}
