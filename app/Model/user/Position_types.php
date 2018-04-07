<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Model\user\Sports;
use App\Model\user\Parameters;

class Position_types extends Model
{
  use FilterPaginateOrder;
  protected $primaryKey = 'position_type_id';
  protected $fillable = ['name','sport_id'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['position_type_id','name','sport_id'];

  public static function initialize(){
    return [
      'name' => '',
      'sport_id' => 'select'
    ];
  }

  public function sport()
  {
      return $this->belongsTo(Sports::class);
  }

  public function parameter()
  {
      return $this->hasMany(Parameters::class);
  }
}
