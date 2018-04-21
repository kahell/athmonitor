<?php

namespace App\Model\Teans;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Model\Teans\Athletes;
use App\Model\Teans\Teams;

class History_athlete extends Model
{
  use FilterPaginateOrder;
  protected $fillable = 'athlete_id','team_id','started_date','end_date'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['id','athlete_id','team_id','started_date','end_date'];

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
