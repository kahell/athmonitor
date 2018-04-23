<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Teams\Achievements;
use Validator, Storage;
use App\Http\Controllers\Api\baseRestController;

class CA_achievement extends Controller
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
        'data' => Achievements::all(),
        'message' => 'Success'
      ],200);
  }

  public function create()
  {
    return response()
      ->json([
        'form' => Achievements::initialize(),
        'option' => []
      ],200);
  }

  public function store(Request $request)
  {
    //validation
    $roles = [];
    foreach (Achievements::formValidation() as $key => $value) {
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
    // Insert Achievements
    $achievement = new Achievements();
    $achievement->name = $request->name;
    $achievement->description = $request->description;
    $achievement->date = $request->date;
    $achievement->level = $request->level;

    // Path for save image
    $pathAchieveImage = [];
    if(!empty($request->team_id)){
      $achievement->team_id = $request->team_id;
      $pathAchieveImage[0] = "team";
      $pathAchieveImage[1] = $request->team_id;
      $pathAchieveImage[2] = "achiement";
      $pathAchieveImage[3] = "image";
    }else if(!empty($request->coach_id)){
      $achievement->coach_id = $request->coach_id;
      $pathAchieveImage[0] = "coach";
      $pathAchieveImage[1] = $request->coach_id;
      $pathAchieveImage[2] = "achiement";
      $pathAchieveImage[3] = "image";
    }else if(!empty($request->athlete_id)){
      $achievement->athlete_id = $request->athlete_id;
      $pathAchieveImage[0] = "team";
      $pathAchieveImage[1] = $request->team_id;
      $pathAchieveImage[2] = "athlete";
      $pathAchieveImage[3] = $request->athlete_id;
    }
    $achievement->save();

    // Insert Image
    if($request->hasFile('file')){
      $file = $request->file('file');
      if (!Storage::exists('public/images/'.$pathAchieveImage[0].'/'.$pathAchieveImage[1].'/'.$pathAchieveImage[2] .'/'.$pathAchieveImage[3])) {
          Storage::makeDirectory('public/images/'.$pathAchieveImage[0].'/'.$pathAchieveImage[1].'/'.$pathAchieveImage[2].'/'.$pathAchieveImage[3], 0777);
      }
      $path = Storage::putFile('public/images/'.$pathAchieveImage[0].'/'.$pathAchieveImage[1].'/'.$pathAchieveImage[2].'/'.$pathAchieveImage[3], $request->file('file'));
      $path = explode('/',$path);
      $insertFile = Achievements::where('id',$achievement->id)->first();
      $insertFile->images = $path[1] . '/' . $path[2] . '/' . $path[3] . '/' . $path[4] . '/' . $path[5] . '/' . $path[6];
      $insertFile->save();
    }

    // Return
    return response()->json([
      'status'=> true,
      'data' => [
        'achievement' => Achievements::findOrFail($achievement->id)
      ],
      'message' => "Add achievement successfully!"
    ], 200);
  }

  public function show($id)
  {
    try {
      // Return
      return response()->json([
        'status'=> TRUE,
        'data' => [
          'achiement' => Achievements::findOrFail($id)
        ],
        'message' => "Your achievement."
      ], 200);
    } catch (\Exception $e) {
      // Return
      return response()->json([
        'status'=> TRUE,
        'data' => null,
        'message' => "Achievement with id " . $id . " does not exists."
      ], 200);
    }

  }

  public function edit($id)
  {
    // Return
    return response()->json([
      'status'=> TRUE,
      'data' => [
        'form' => Achievements::initialize()
      ],
      'message' => "Edit your achievement."
    ], 200);
  }

  public function update(Request $request, $id)
  {
    //validation
    $roles = [];
    foreach (Achievements::formValidation() as $key => $value) {
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
      $achievement = Achievements::findOrFail($id);
      $achievement->update($request->all());
      // Delete Image Team Before if there an image files
      if($request->hasFile('file')){
        $pathImage = 'public/'.$achievement['images'];
        Storage::delete($pathImage);
        //Insert new Image
        $file = $request->file('file');
        // Path for save image
        $pathAchieveImage = [];
        if(!empty($request->team_id)){
          $pathAchieveImage[0] = "team";
          $pathAchieveImage[1] = $request->team_id;
          $pathAchieveImage[2] = "achiement";
          $pathAchieveImage[3] = "image";
        }else if(!empty($request->coach_id)){
          $pathAchieveImage[0] = "coach";
          $pathAchieveImage[1] = $request->coach_id;
          $pathAchieveImage[2] = "achiement";
          $pathAchieveImage[3] = "image";
        }else if(!empty($request->athlete_id)){
          $pathAchieveImage[0] = "team";
          $pathAchieveImage[1] = $request->team_id;
          $pathAchieveImage[2] = "athlete";
          $pathAchieveImage[3] = $request->athlete_id;
        }
        if (!Storage::exists('public/images/'.$pathAchieveImage[0].'/'.$pathAchieveImage[1].'/'.$pathAchieveImage[2] .'/'.$pathAchieveImage[3])) {
            Storage::makeDirectory('public/images/'.$pathAchieveImage[0].'/'.$pathAchieveImage[1].'/'.$pathAchieveImage[2].'/'.$pathAchieveImage[3], 0777);
        }
        $path = Storage::putFile('public/images/'.$pathAchieveImage[0].'/'.$pathAchieveImage[1].'/'.$pathAchieveImage[2].'/'.$pathAchieveImage[3], $request->file('file'));
        $path = explode('/',$path);
        $insertFile = Achievements::where('id',$achievement->id)->first();
        $insertFile->images = $path[1] . '/' . $path[2] . '/' . $path[3] . '/' . $path[4] . '/' . $path[5] . '/' . $path[6];
        $insertFile->save();
      }
      return response()->json([
        'status'=> true,
        'data' => Achievements::findOrFail($id),
        'message' => "Update achievement successfully!"
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
      $achievement = Achievements::findOrFail($id);
      // Delete images on Storage
      $pathImage = 'public/'.$achievement['images'];
      Storage::delete($pathImage);
      $achievement->delete();
      return response()->json([
        'status'=> true,
        'data' => null,
        'message' => "Delete achievement successfully!"
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => "Achievement with id " . $id . " does not exists."
      ], 200);
    }
  }
}
