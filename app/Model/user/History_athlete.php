<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Model\user\Athletes;
use App\Model\user\Teams;

class History_athlete extends Model
{
  use FilterPaginateOrder;
  protected $primaryKey = 'history_athlete_id';
  protected $fillable = 'athlete_id','team_id','started_date','end_date'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['history_athlete_id','athlete_id','team_id','started_date','end_date'];

  public static function initialize(){
    return [
      'athlete_id' => 'select',
      'team_id' => 'select',
      'started_date' => date('Y-m-d H:i:s'),
      'end_date' => date('Y-m-d H:i:s')
    ];
  }

  public function team()
  {
      return $this->belongsTo(Teams::class);
  }

  public function athlete()
  {
      return $this->belongsTo(Athletes::class);
  }
}
