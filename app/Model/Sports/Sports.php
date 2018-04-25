<?php

namespace App\Model\Sports;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Model\Users\User;
use App\Model\Sports\Position_types;

class Sports extends Model
{
    use FilterPaginateOrder;
    protected $fillable = ['name','description'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $filter = ['id','name','description'];

    public static function initialize(){
      return [
        'name' => '',
        'description' => ''
      ];
    }

    public function coach()
    {
        return $this->hasMany(Coaches::class,'sport_id');
    }

    public function position_type()
    {
        return $this->hasMany(Position_types::class,'sport_id');
    }
    public function parameter()
    {
        return $this->hasMany(Parameters::class,'sport_id');
    }
}
