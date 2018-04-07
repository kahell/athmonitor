<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;
use App\Model\user\Teams;
use App\Model\user\Scores;
use App\Support\FilterPaginateOrder;

class Activities extends Model
{
  use FilterPaginateOrder;
  protected $primaryKey = 'activity_id';
  protected $fillable = ['team_id', 'time','place','type'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['activity_id','team_id', 'time','place','type'];

  public static function initialize(){
    return [
      'team_id' => 'select', 'time' => date('Y-m-d H:i:s'),'place' => '','type' => 1
    ];
  }

  public function score()
  {
    return $this->hasMany(Scores::class);
  }

  public function team()
  {
    return $this->belongsTo(Teams::class);
  }
}
