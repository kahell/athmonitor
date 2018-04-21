<?php

namespace App\Model\Teams;

use Illuminate\Database\Eloquent\Model;
use App\Model\Users\User;
use App\Model\Teams\Athletes;
use App\Model\Teams\Achievements;
use App\Model\Teams\History_coaches;
use App\Model\Teams\History_athlete;
use App\Model\Teams\Activities;
use App\Support\FilterPaginateOrder;
use App\Rules\ValidCoach;

class Teams extends Model
{
  use FilterPaginateOrder;
  protected $fillable = ['name', 'description','avatar','address','city','province','coach_id'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['id','name', 'description','avatar','address','city','province','coach_id'];

  public static function initialize(){
    return [
      'name' => '', 'description' => '','avatar' => '','address' => '','city' => '','province' => '','coach_id' => ''
    ];
  }

  public static function formValidation(){
    return [
      'name' => 'required|min:4|max:25',
      'description' => 'required',
      'file' => 'required|mimes:jpg,jpeg,png|max:10000|',
      'address' => 'required',
      'city' => 'required',
      'province' => 'required',
      'coach_id' => ['required', new ValidCoach]
    ];
  }

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function athlete()
  {
      return $this->hasMany(Athletes::class,'team_id');
  }

  public function achievement()
  {
      return $this->hasMany(Achievements::class,'team_id');
  }

  public function history_coach()
  {
      return $this->hasMany(History_coaches::class,'team_id');
  }

  public function history_athlete()
  {
      return $this->hasMany(History_athlete::class,'team_id');
  }

  public function activity()
  {
    return $this->hasMany(Activities::class,'team_id');
  }

}
