<?php

namespace App\Model\user;
use App\Model\user\Achievements;
use App\Model\user\Coaches;
use App\Model\user\Teams;
use App\Model\user\Scores;
use App\Model\user\History_athlete;
use App\Support\FilterPaginateOrder;

use Illuminate\Database\Eloquent\Model;

class Athletes extends Model
{
  use FilterPaginateOrder;
  protected $primaryKey = 'athlete_id';
  protected $fillable = ['coach_id', 'team_id','position_type_id','achieve_key','fullname','gender','avatar','address','bod','phone_number','player_number','player_status'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['athlete_id','coach_id', 'team_id','position_type_id','achieve_key','fullname','gender','avatar','address','bod','phone_number','player_number','player_status'];

  public static function initialize(){
    return [
      'coach_id' => 'select', 'team_id' => 'select','position_type_id' => 'select','achieve_key' => '','fullname' => ''
      'gender' => 1, 'avatar' => '', 'address' => '', 'bod' => '', 'phone_number' => '', 'player_number' => '', 'player_status' => 1
    ];
  }

  public function coach()
  {
      return $this->belongsTo(Coaches::class);
  }

  public function team()
  {
      return $this->belongsTo(Teams::class);
  }

  public function achievement()
  {
      return $this->hasMany(Achievements::class);
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
