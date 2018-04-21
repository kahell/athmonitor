<?php

namespace App\Model\Sports;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Model\Sports\Position_type;
use App\Model\Teams\Scores;

class Parameters extends Model
{
  use FilterPaginateOrder;
  protected $fillable = ['name','position_type_id'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['id','name','position_type_id'];

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
