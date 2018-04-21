<?php

namespace App\Model\Users;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Support\FilterPaginateOrder;
use App\Model\Users\Statuses;
use App\Model\Sports\Roles;
use App\Model\Sports\Sports;
use App\Model\Teams\Athletes;
use App\Model\Teams\Coaches;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use FilterPaginateOrder;

    protected $fillable = ['fullname', 'gender','avatar','address','bod','phone_number','role_id','username','email',
    'statuses.account_status_id','statuses.failedLoginAttempt','statuses.blocked_time', 'statuses.last_login','statuses.isBlocked','statuses.accVerificationCode',
    'statuses.isResetCode','statuses.resetPassVerificationCode'];
    protected $hidden = ['password', 'remember_token'];
    protected $filter = ['user_id','fullname', 'gender','avatar','address','bod','phone_number','role_id','username','email',
    'statuses.account_status_id','statuses.failedLoginAttempt','statuses.blocked_time', 'statuses.last_login','statuses.isBlocked','statuses.accVerificationCode',
    'statuses.isResetCode','statuses.resetPassVerificationCode'
    ];

    public static function initialize(){
      return [
        'name' => '', 'description' => '','avatar' => '','address' => '','city' => '','province' => '',
      ];
    }

    public function status()
    {
        return $this->hasOne(Statuses::class);
    }

    public function role()
    {
        return $this->belongsToMany(Roles::class);
    }

    public function athlete()
    {
        return $this->hasMany(Athletes::class);
    }

    public function coach()
    {
        return $this->hasOne(Coaches::class);
    }

    public function sport()
    {
        return $this->belongsToMany(Sports::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
