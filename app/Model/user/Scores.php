<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;
use App\Model\user\Parameters;
use App\Model\user\Athletes;
use App\Model\user\Activities;
use App\Support\FilterPaginateOrder;

class Scores extends Model
{
  use FilterPaginateOrder;
  protected $primaryKey = 'score_id';
  protected $fillable = ['parameter_id','value','athlete_id','activity_id'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['score_id','parameter_id','value','athlete_id','activity_id'];

  public static function initialize(){
    return [
      'parameter_id' => 'select',
      'value' => '',
      'athlete_id' => 'select',
      'activity_id' => 'select'
    ];
  }

  public function parameter()
  {
    return $this->belongsTo(Parameters::class);
  }

  public function athlete()
  {
    return $this->belongsTo(Athletes::class);
  }

  public function activity()
  {
    return $this->belongsTo(Activities::class);
  }
}
