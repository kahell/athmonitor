<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;
use App\Support\FilterPaginateOrder;
use App\Model\user\Coaches;
use App\Model\user\Position_type;

class Sports extends Model
{
    use FilterPaginateOrder;
    protected $primaryKey = 'sport_id';
    protected $fillable = ['name','description'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $filter = ['sport_id','name','description'];

    public static function initialize(){
      return [
        'name' => '',
        'description' => ''
      ];
    }

    public function coach()
    {
        return $this->belongsTo(Coaches::class);
    }

    public function position_type()
    {
        return $this->hasMany(Position_type::class);
    }
}
