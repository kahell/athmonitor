<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;
use App\Model\user\Coaches;
use App\Model\user\Athletes;
use App\Model\user\Teams;
use App\Support\FilterPaginateOrder;

class Achievements extends Model
{

    use FilterPaginateOrder;
    protected $primaryKey = 'achievement_id';
    protected $fillable = ['name', 'description','image','level','achieve_key'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $filter = ['achievement_id','name', 'description','image','level','achieve_key'];

    public static function initialize(){
      return [
        'name' => '', 'description' => '','image' => '','level' => 1,'achieve_key' => ''
      ];
    }

    public function coach()
    {
        return $this->belongsTo(Coaches::class);
    }

    public function athlete()
    {
        return $this->belongsTo(Athletes::class);
    }

    public function team()
    {
        return $this->belongsTo(Teams::class);
    }

}
