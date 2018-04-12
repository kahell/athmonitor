<?php

namespace App\Model\user;

use App\Model\user\User;
use App\Model\user\Statuses;
use App\Model\user\Sports;
use App\Model\user\Roles;
use App\Model\user\Achievements;
use App\Model\user\Teams;
use App\Model\user\Athletes;
use App\Model\user\History_coaches;
use App\Support\FilterPaginateOrder;
use Illuminate\Database\Eloquent\Model;

class Coaches extends Model
{
    use FilterPaginateOrder;

    protected $primaryKey = 'coach_id';
    protected $fillable = ['user_id','sport_id','achieve_key'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $filter = ['achieve_key','user_id', 'sport_id','sport.name','sport.description',
    'user.fullname', 'user.gender','user.avatar','user.address','user.bod','user.phone_number',
    'user.status_id','user.role_id','user.username','user.password'
    ];

    public static function initialize(){
      return [
        'sport_id' => 'select',
        'achieve_key' => '',
        'fullname' => '',
        'gender' => 0,
        'avatar' => '',
        'address' => '',
        'bod' => '',
        'phone_number' => '',
        'email' => '',
        'account_status_id' => ''
      ];
    }

    public function achievement()
    {
        return $this->hasMany(Achievements::class,'achieve_key','achieve_key');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->join('roles','roles.role_id','=','users.role_id');
    }

    public function status()
    {
        return $this->belongsTo(Statuses::class,'user_id');
    }

    public function sport()
    {
        return $this->belongsTo(Sports::class,'sport_id');
    }

    public function team()
    {
        return $this->hasMany(Teams::class,'coach_id');
    }

    public function history_coach()
    {
        return $this->hasMany(History_coaches::class);
    }

    public function athlete()
    {
        return $this->hasMany(Athletes::class);
    }
}
