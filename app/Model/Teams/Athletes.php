<?php

namespace App\Model\Teams;

use App\Model\Teams\Achievements;
use App\Model\Teams\Teams;
use App\Model\Teams\Scores;
use App\Model\Sports\Position_types;
use App\Model\Teams\History_athlete;
use App\Support\FilterPaginateOrder;
use App\Rules\ValidPhone;
use App\Rules\ValidTeam;
use App\Rules\ValidPositionType;

use Illuminate\Database\Eloquent\Model;

class Athletes extends Model
{
  use FilterPaginateOrder;
  protected $fillable = ['team_id','position_type_id','fullname','gender','avatar','address','bod','phone_number','player_number','player_status'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['id','team_id','position_type_id','fullname','gender','avatar','address','bod','phone_number','player_number','player_status'];

  public static function initialize(){
    return [
      'team_id' => "Team",'position_type_id' => "Position",'fullname' => "Name",
      'gender' => "Gender", 'avatar' => "Avatar", 'address' => 'Address', 'bod' => 'Date of Birth', 'phone_number' => 'Phone Number', 'player_number' => 'Player Number', 'player_status' => "Status"
    ];
  }

  public static function formValidation(){
    return [
      'fullname' => 'required|min:4|max:255',
      'gender' => 'required',
      'file' => 'required|mimes:jpg,jpeg,png|max:10000|',
      'address' => 'required',
      'bod' => 'required',
      'player_number' => 'required|min:1',
      'player_status' => 'required',
      'phone_number' => ['required', new ValidPhone],
      'team_id' => ['required', new ValidTeam],
      'position_type_id' => ['required', new ValidPositionType]
    ];
  }

  public function team()
  {
      return $this->belongsTo(Teams::class);
  }

  public function achievement()
  {
      return $this->hasMany(Achievements::class);
  }

  public function position_type()
  {
      return $this->belongsTo(Position_types::class);
  }

  public function score()
  {
    return $this->hasMany(Scores::class);
  }

  public function history_athlete()
  {
      return $this->hasMany(History_athlete::class);
  }
}
