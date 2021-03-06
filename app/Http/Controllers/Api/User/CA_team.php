<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Teams\Teams;
use Validator, Storage;
use App\Http\Controllers\Api\baseRestController;

class CA_team extends Controller
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
          'data' => Teams::all(),
          'message' => 'Success'
        ],200);
    }

    public function create()
    {
      return response()
        ->json([
          'form' => Teams::initialize(),
          'option' => []
        ],200);
    }

    public function store(Request $request)
    {
      //validation
      $roles = [];
      foreach (Teams::formValidation() as $key => $value) {
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

      // Insert Teams
      $team = new Teams();
      $team->name = $request->name;
      $team->description = $request->description;
      $team->address = $request->address;
      $team->city = $request->city;
      $team->province = $request->province;
      $team->coach_id = $request->coach_id;
      $team->save();

      // Insert Image
      if($request->hasFile('file')){
        $file = $request->file('file');
        if (!Storage::exists('public/images/team/'.$team->id)) {
            Storage::makeDirectory('public/images/team/'.$team->id, 0777);
        }
        $path = Storage::putFile('public/images/team/'.$team->id, $request->file('file'));
        $path = explode('/',$path);
        $insertFile = Teams::where('id',$team->id)->first();
        $insertFile->avatar = $path[1] . '/' . $path[2] . '/' . $path[3]. '/' . $path[4] ;
        $insertFile->save();
      }

      // Return
      return response()->json([
        'status'=> true,
        'data' => [
          'url' => 'users/'.$team->id.'/team'
        ],
        'message' => "Add team successfully!"
      ], 200);
    }

    public function show($id)
    {
      $team =  Teams::find($id)->first();
      $athlete = Teams::find($id)->athlete;
      $achievement = Teams::find($id)->achievement;
      $activity = Teams::find($id)->activity;
      // Return
      return response()->json([
        'status'=> TRUE,
        'data' => [
          'team' => $team,
          'athlete' => $athlete,
          'achievement' => $achievement,
          'activity' => $activity
        ],
        'message' => "Your team."
      ], 200);
    }

    public function edit($id)
    {
      // Return
      return response()->json([
        'status'=> TRUE,
        'data' => [
          'form' => Teams::initialize()
        ],
        'message' => "Edit your team."
      ], 200);
    }

    public function update(Request $request, $id)
    {
      //validation
      $roles = [];
      foreach (Teams::formValidation() as $key => $value) {
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
        $team = Teams::findOrFail($id);
        $team->update($request->all());

        // Delete Image Team Before if there an image files
        if($request->hasFile('file')){
          $pathImage = 'public/'.$team['avatar'];
          Storage::delete($pathImage);
          //Insert new Image
          $file = $request->file('file');
          if (!Storage::exists('public/images/team')) {
              Storage::makeDirectory('public/images/team', 0777);
          }
          $path = Storage::putFile('public/images/team', $request->file('file'));
          $path = explode('/',$path);
          $insertFile = Teams::where('id',$team->id)->first();
          $insertFile->avatar = $path[1] . '/' . $path[2] . '/' . $path[3];
          $insertFile->save();
        }
        return response()->json([
          'status'=> true,
          'data' => Teams::findOrFail($id),
          'message' => "Update team successfully!"
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
        $team = Teams::findOrFail($id);
        // Delete images on Storage
        $pathImage = 'public/'.$team['avatar'];
        Storage::delete($pathImage);
        $team->delete();
        return response()->json([
          'status'=> true,
          'data' => null,
          'message' => "Delete team successfully!"
        ], 200);
      } catch (\Exception $e) {
        return $this->displayDataNotFound();
      }
    }
}
