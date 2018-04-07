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
  'last_login','isBlocked','accVerificationCode','isResetCode','resetPassVerificationCode'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $filter = ['status_id','user_id','account_status_id','failedLoginAttempt','blocked_time',
  'last_login','isBlocked','accVerificationCode','isResetCode','resetPassVerificationCode'];

  public static function initialize(){
    return [
      'user_id' => '',
      'account_status_id' => '',
      'failedLoginAttempt' => '',
      'blocked_time' => '',
      'last_login' => '',
      'isBlocked' => '',
      'accVerificationCode' => '',
      'isResetCode' => '',
      'resetPassVerificationCode' => ''
    ];
  }

  public function user()
  {
      return $this->belongsTo(User::class);
  }
}
