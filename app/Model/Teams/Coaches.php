<?php

namespace App\Model\Teams;

use Illuminate\Database\Eloquent\Model;
use App\Model\Users\User;
use App\Model\Teams\Teams;
use App\Model\Sports\Sports;

class Coaches extends Model
{

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function team()
  {
      return $this->hasMany(Teams::class,'coach_id');
  }

  public function sport()
  {
      return $this->belongsTo(Sports::class);
  }

}
