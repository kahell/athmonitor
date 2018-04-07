<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Model\user\User;

class Roles extends Model
{
  use FilterPaginateOrder;
  protected $primaryKey = 'role_id';
  protected $fillable = ['name'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['role_id','name'];

  public static function initialize(){
    return [
      'name' => ''
    ];
  }

  public function user()
  {
      return $this->belongsTo(User::class);
  }
}
