<?php

namespace App\Http\Controllers\Api\Sports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Sports\Parameters;
use Validator, Storage;
use App\Http\Controllers\Api\baseRestController;

class CA_parameter extends Controller
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
        'data' => Parameters::all(),
        'message' => 'Success'
      ],200);
  }

  public function create()
  {
    return response()
      ->json([
        'form' => Parameters::initialize(),
        'option' => []
      ],200);
  }

  public function store(Request $request)
  {
    //validation
    $roles = [];
    foreach (Parameters::formValidation() as $key => $value) {
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
    // Insert Parameters
    $parameter = Parameters::create($request->all());

    // Return
    return response()->json([
      'status'=> true,
      'data' => null,
      'message' => "Add parameter successfully!"
    ], 200);
  }

  public function show($id)
  {
    // Return
    try {
      $parameter = Parameters::findOrFail($id);
    } catch (\Exception $e) {
      return response()->json([
        'status'=> TRUE,
        'data' => null,
        'message' => "Parameter with id " . $id ." does not exist."
      ], 200);
    }
    return response()->json([
      'status'=> TRUE,
      'data' => [
        'parameter' => $parameter
      ],
      'message' => "Your parameter."
    ], 200);

  }

  public function edit($id)
  {
    // Return
    return response()->json([
      'status'=> TRUE,
      'data' => [
        'form' => Parameters::initialize()
      ],
      'message' => "Edit your parameter."
    ], 200);
  }

  public function update(Request $request, $id)
  {
    //validation
    $roles = [];
    foreach (Parameters::formValidation() as $key => $value) {
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
      $parameter = Parameters::findOrFail($id);
      $parameter->update($request->all());
      // Return
      return response()->json([
        'status'=> true,
        'data' => Parameters::findOrFail($id),
        'message' => "Update parameter successfully!"
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
      $parameter = Parameters::findOrFail($id);
      $parameter->delete();
      return response()->json([
        'status'=> true,
        'data' => null,
        'message' => "Delete parameter successfully!"
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => "Parameter with id " . $id." does not exist."
      ], 200);
    }
  }
}
