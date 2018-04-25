<?php

namespace App\Model\Teams;

use Illuminate\Database\Eloquent\Model;
use App\Model\Sports\Parameters;
use App\Model\Teams\Athletes;
use App\Model\Teams\Activities;
use App\Support\FilterPaginateOrder;
use App\Rules\ValidParameter;

class Scores extends Model
{
  use FilterPaginateOrder;
  protected $fillable = ['parameter_id','value','athlete_id','activity_id'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['id','parameter_id','value','athlete_id','activity_id'];

  public static function initialize(){
    return [
      'parameter_id' => 'Paramter',
      'value' => '',
      'athlete_id' => 'Athlete',
      'activity_id' => 'Activity'
    ];
  }

  public static function formValidation(){
    return [
      'parameter_id' => ['required', new ValidParameter],
      'value' => 'required',
      'athlete_id' => ['required', new ValidAthlete],
      'activity_id' => ['required', new ValidActivity]
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
