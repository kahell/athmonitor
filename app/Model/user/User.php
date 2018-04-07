<?php

namespace App\Model\user;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Support\FilterPaginateOrder;
use App\Model\user\Statuses;
use App\Model\user\Roles;

class User extends Authenticatable
{
    use Notifiable;
    use FilterPaginateOrder;

    protected $primaryKey = 'user_id';
    protected $fillable = ['fullname', 'gender','avatar','address','bod','phone_number','status_id','role_id','username','password',
    'status.account_status_id','status.failedLoginAttempt','status.blocked_time', 'status.last_login','status.isBlocked','status.accVerificationCode',
    'status.isResetCode','status.resetPassVerificationCode'];
    protected $hidden = ['password', 'remember_token'];
    protected $filter = ['user_id','fullname', 'gender','avatar','address','bod','phone_number','status_id','role_id','username','password',
    'status.account_status_id','status.failedLoginAttempt','status.blocked_time', 'status.last_login','status.isBlocked','status.accVerificationCode',
    'status.isResetCode','status.resetPassVerificationCode'
    ];

    public function status()
    {
        return $this->hasOne(Statuses::class);
    }

    public function role()
    {
        return $this->hasOne(Roles::class);
    }
}
