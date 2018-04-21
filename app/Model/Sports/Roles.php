<?php

namespace App\Model\Sports;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Model\Users\User;

class Roles extends Model
{
  use FilterPaginateOrder;
  protected $fillable = ['name'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['id','name'];

  public static function initialize(){
    return [
      'name' => ''
    ];
  }

  public function user()
  {
      return $this->belongsToMany(User::class);
  }
}
