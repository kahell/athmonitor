<?php

namespace App\Model\Teams;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Model\Teams\Coaches;
use App\Model\Teams\Teams;

class History_coach extends Model
{
  use FilterPaginateOrder;
  protected $fillable = ['coach_id','team_id','started_date','end_date'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['id','coach_id','team_id','started_date','end_date'];

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
