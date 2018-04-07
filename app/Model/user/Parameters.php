<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Model\user\Position_type;
use App\Model\user\Scores;

class Parameters extends Model
{
  use FilterPaginateOrder;
  protected $primaryKey = 'parameter_id';
  protected $fillable = ['name','position_type_id'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['parameter_id','name','position_type_id'];

  public static function initialize(){
    return [
      'name' => '',
      'position_type_id' => 'select'
    ];
  }

  public function position_type()
  {
      return $this->belongsTo(Position_type::class);
  }

  public function score()
  {
    return $this->belongsTo(Scores::class);
  }
}
