<?php

namespace App\Model\user;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Support\FilterPaginateOrder;
use App\Model\user\Statuses;
use App\Model\user\Roles;
use App\Model\user\Coaches;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use FilterPaginateOrder;

    protected $primaryKey = 'user_id';
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
        'achieve_key' => '','coach_id' => ''
      ];
    }

    public function status()
    {
        return $this->hasOne(Statuses::class);
    }

    public function role()
    {
        return $this->hasOne(Roles::class);
    }

    public function coach()
    {
        return $this->belongsTo(Coaches::class);
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
