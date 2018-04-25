<?php

namespace App\Model\Sports;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Model\Sports\Sports;
use App\Model\Teams\Scores;
use App\Rules\ValidSport;

class Parameters extends Model
{
  use FilterPaginateOrder;
  protected $fillable = ['name','sport_id'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['id','name','sport_id'];

  public static function initialize(){
    return [
      'name' => 'Name',
      'sport_id' => 'Position'
    ];
  }
  public static function formValidation(){
    return [
      'name' => 'required|min:3|max:255',
      'sport_id' => ['required', new ValidSport]
    ];
  }

  public function sport()
  {
      return $this->belongsTo(Sports::class);
  }

  public function score()
  {
    return $this->hasOne(Scores::class,'parameter_id');
  }
}
