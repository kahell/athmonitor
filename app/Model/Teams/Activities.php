<?php

namespace App\Model\Teams;

use Illuminate\Database\Eloquent\Model;
use App\Model\Teams\Teams;
use App\Model\Teams\Scores;
use App\Support\FilterPaginateOrder;
use App\Rules\ValidTeam;

class Activities extends Model
{
  use FilterPaginateOrder;
  protected $fillable = ['team_id', 'time','place','type','status'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['id','team_id', 'time','place','type','status'];

  public static function initialize(){
    return [
      'team_id' => 'Team', 'time' => "Time", 'place' => 'Place','type' => "Type",'status' => "Status"
    ];
  }

  public static function formValidation(){
    return [
      'time' => 'required',
      'place' => 'required',
      'type' => 'required',
      'status' => 'required',
      'team_id' => ['required', new ValidTeam]
    ];
  }

  public function score()
  {
    return $this->hasMany(Scores::class,'score_id');
  }

  public function team()
  {
    return $this->belongsTo(Teams::class);
  }
}
