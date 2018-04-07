<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Model\user\Coaches;
use App\Model\user\Teams;

class History_coaches extends Model
{
  use FilterPaginateOrder;
  protected $primaryKey = 'history_coach_id';
  protected $fillable = ['coach_id','team_id','started_date','end_date'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['history_coach_id','coach_id','team_id','started_date','end_date'];

  public static function initialize(){
    return [
      'coach_id' => 'select',
      'team_id' => 'select',
      'started_date' => date('Y-m-d H:i:s'),
      'end_date' => date('Y-m-d H:i:s')
    ];
  }

  public function team()
  {
      return $this->belongsTo(Teams::class);
  }

  public function coach()
  {
      return $this->belongsTo(Coaches::class);
  }
}
