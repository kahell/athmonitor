<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Teams\Athletes;
use Validator, Storage;
use App\Http\Controllers\Api\baseRestController;

class CA_athlete extends Controller
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
        'data' => Athletes::all(),
        'message' => 'Success'
      ],200);
  }

  public function create()
  {
    return response()
      ->json([
        'form' => Athletes::initialize(),
        'option' => []
      ],200);
  }

  public function store(Request $request)
  {
    //validation
    $roles = [];
    foreach (Athletes::formValidation() as $key => $value) {
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
    // Validation Image because Image is required when store
    if(!$request->hasFile('file')){
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => "Image is required."
      ], 200);
    }
    // Insert Athletes
    $athlete = new Athletes();
    $athlete->fullname = $request->fullname;
    $athlete->gender = $request->gender;
    $athlete->address = $request->address;
    $athlete->bod = $request->bod;
    $athlete->phone_number = $request->phone_number;
    $athlete->player_number = $request->player_number;
    $athlete->player_status = $request->player_status;
    $athlete->team_id = $request->team_id;
    $athlete->position_type_id = $request->position_type_id;
    $athlete->save();

    // Insert Image
    if($request->hasFile('file')){
      $file = $request->file('file');
      if (!Storage::exists('public/images/team/'.$request->team_id.'/athlete')) {
          Storage::makeDirectory('public/images/team/'.$request->team_id.'/athlete', 0777);
      }
      $path = Storage::putFile('public/images/team/'.$request->team_id.'/athlete', $request->file('file'));
      $path = explode('/',$path);
      $insertFile = Athletes::where('id',$athlete->id)->first();
      $insertFile->avatar = $path[1] . '/' . $path[2] . '/' . $path[3] . '/' . $path[4] . '/' . $path[5];
      $insertFile->save();
    }

    // Return
    return response()->json([
      'status'=> true,
      'data' => [
        'athlete' => Athletes::with(['position_type'])->findOrFail($athlete->id)
      ],
      'message' => "Add athlete successfully!"
    ], 200);
  }

  public function show($id)
  {
    $athlete =  Athletes::find($id)->first();
    $team = Athletes::find($id)->team;
    $achievement = Athletes::find($id)->achievement;
    $position_type = Athletes::find($id)->position_type;
    // Return
    return response()->json([
      'status'=> TRUE,
      'data' => [
        'team' => $team,
        'athlete' => $athlete,
        'achievement' => $achievement,
        'position_type' => $activity
      ],
      'message' => "Your Athlete."
    ], 200);
  }

  public function edit($id)
  {
    // Return
    return response()->json([
      'status'=> TRUE,
      'data' => [
        'form' => Athletes::initialize()
      ],
      'message' => "Edit your team."
    ], 200);
  }

  public function update(Request $request, $id)
  {
    //validation
    $roles = [];
    foreach (Athletes::formValidation() as $key => $value) {
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
      $athlete = Athletes::findOrFail($id);
      $athlete->update($request->all());
      // Delete Image Team Before if there an image files
      if($request->hasFile('file')){
        $pathImage = 'public/'.$athlete['avatar'];
        Storage::delete($pathImage);
        //Insert new Image
        $file = $request->file('file');
        if (!Storage::exists('public/images/team/'.$request->team_id.'/athlete')) {
            Storage::makeDirectory('public/images/team/'.$request->team_id.'/athlete', 0777);
        }
        $path = Storage::putFile('public/images/team/'.$request->team_id.'/athlete', $request->file('file'));
        $path = explode('/',$path);
        $insertFile = Athletes::where('id',$athlete->id)->first();
        $insertFile->avatar = $path[1] . '/' . $path[2] . '/' . $path[3]. '/' . $path[4]. '/' . $path[5];
        $insertFile->save();
      }
      return response()->json([
        'status'=> true,
        'data' => Athletes::findOrFail($id),
        'message' => "Update athlete successfully!"
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
      $athlete = Athletes::findOrFail($id);
      // Delete images on Storage
      $pathImage = 'public/'.$athlete['avatar'];
      Storage::delete($pathImage);
      $athlete->delete();
      return response()->json([
        'status'=> true,
        'data' => null,
        'message' => "Delete athlete successfully!"
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => $e
      ], 200);
    }
  }
}
