<?php

namespace App\Model\Teams;

use Illuminate\Database\Eloquent\Model;
use App\Model\Teams\Teams;
use App\Model\Teams\Scores;
use App\Support\FilterPaginateOrder;

class Activities extends Model
{
  use FilterPaginateOrder;
  protected $fillable = ['team_id', 'time','place','type'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['id','team_id', 'time','place','type'];

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
