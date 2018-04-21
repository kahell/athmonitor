<?php

namespace App\Model\Teams;

use Illuminate\Database\Eloquent\Model;
use App\Model\Teams\Coaches;
use App\Model\Teams\Athletes;
use App\Model\Teams\Teams;
use App\Support\FilterPaginateOrder;

class Achievements extends Model
{

    use FilterPaginateOrder;
    protected $fillable = ['name', 'description','image','level','achieve_key','user_id','athlete_id','team_id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $filter = ['id','name', 'description','image','level','achieve_key','user_id','athlete_id','team_id'];

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
