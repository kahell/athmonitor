<?php

namespace App\Model\Teams;

use App\Model\Teams\Achievements;
use App\Model\Teams\Teams;
use App\Model\Teams\Scores;
use App\Model\Sports\Position_types;
use App\Model\Teams\History_athlete;
use App\Support\FilterPaginateOrder;

use Illuminate\Database\Eloquent\Model;

class Athletes extends Model
{
  use FilterPaginateOrder;
  protected $fillable = ['team_id','position_type_id','fullname','gender','avatar','address','bod','phone_number','player_number','player_status'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['id','team_id','position_type_id','fullname','gender','avatar','address','bod','phone_number','player_number','player_status'];

  public static function initialize(){
    return [
      'team_id' => 'select','position_type_id' => 'select','fullname' => '',
      'gender' => 1, 'avatar' => '', 'address' => '', 'bod' => '', 'phone_number' => '', 'player_number' => '', 'player_status' => 1
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
