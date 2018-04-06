<?php

namespace App\Model\user;

use App\Model\user\User;
use App\Model\user\Sports;
use App\Model\user\Achievements;
use Illuminate\Database\Eloquent\Model;


class Coaches extends Model
{
    protected $fillable = ['user_id','sport_id','achieve_id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $filter = ['achieve_id','user_id', 'sport_id'];

    public static function initialize(){
      return [
        'user_id' => '','sport_id' => '','achieve_id' => ''
      ];
    }

    public function achievement()
    {
        return $this->hasMany(Achievements::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sport()
    {
        return $this->hasOne(Sports::class);
    }
}
