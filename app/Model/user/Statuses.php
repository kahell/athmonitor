<?php

namespace App\Model\user;

use App\Model\user\User;
use App\Support\FilterPaginateOrder;
use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
  use FilterPaginateOrder;

  protected $primaryKey = 'status_id';
  protected $fillable = ['user_id','account_status_id','failedLoginAttempt','blocked_time',
  'last_login','isBlocked','accVerificationCode','isResetPass','resetPassVerificationCode'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['status_id','user_id','account_status_id','failedLoginAttempt','blocked_time',
  'last_login','isBlocked','accVerificationCode','isResetPass','resetPassVerificationCode'];

  public static function initialize(){
    return [
      'user_id' => '',
      'account_status_id' => '',
      'failedLoginAttempt' => '',
      'blocked_time' => '',
      'last_login' => '',
      'isBlocked' => '',
      'accVerificationCode' => '',
      'isResetPass' => '',
      'resetPassVerificationCode' => ''
    ];
  }

  public function user()
  {
      return $this->belongsToMany(User::class,'user_id');
  }
}
