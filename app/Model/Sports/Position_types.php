<?php

namespace App\Model\Sports;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Model\Sports\Sports;
use App\Model\Sports\Parameters;
use App\Model\Teams\Athletes;
use App\Rules\ValidSport;

class Position_types extends Model
{
  use FilterPaginateOrder;
  protected $fillable = ['name','sport_id'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['id','name','sport_id'];

  public static function initialize(){
    return [
      'name' => 'Name',
      'sport_id' => 'Sport'
    ];
  }

  public static function formValidation(){
    return [
      'name' => 'required|min:4|max:255',
      'sport_id' => ['required', new ValidSport]
    ];
  }

  public function sport()
  {
      return $this->belongsTo(Sports::class);
  }

  public function athlete()
  {
      return $this->hasOne(Athletes::class);
  }

  public function parameter()
  {
      return $this->hasMany(Parameters::class);
  }
}
