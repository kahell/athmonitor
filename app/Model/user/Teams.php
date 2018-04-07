<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;
use App\Model\user\Coaches;
use App\Model\user\Athletes;
use App\Model\user\Achievements;
use App\Model\user\History_coaches;
use App\Model\user\History_athlete;
use App\Model\user\Activities;
use App\Support\FilterPaginateOrder;

class Teams extends Model
{
  use FilterPaginateOrder;
  protected $primaryKey = 'team_id';
  protected $fillable = ['name', 'description','avatar','address','city','province','achieve_key','coach_id'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['team_id','name', 'description','avatar','address','city','province','achieve_key','coach_id'];

  public static function initialize(){
    return [
      'name' => '', 'description' => '','avatar' => '','address' => '','city' => '','province' => '',
      'achieve_key' => '','coach_id' => ''
    ];
  }

  public function coach()
  {
      return $this->belongsTo(Coaches::class);
  }

  public function athlete()
  {
      return $this->hasMany(Athletes::class);
  }

  public function achievement()
  {
      return $this->hasMany(Achievements::class);
  }

  public function history_coach()
  {
      return $this->hasMany(History_coaches::class);
  }

  public function history_athlete()
  {
      return $this->hasMany(History_athlete::class);
  }

  public function activity()
  {
    return $this->hasMany(Activities::class);
  }

}
