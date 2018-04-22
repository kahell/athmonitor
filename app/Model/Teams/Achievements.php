<?php

namespace App\Model\Teams;

use Illuminate\Database\Eloquent\Model;
use App\Model\Teams\Coaches;
use App\Model\Teams\Athletes;
use App\Model\Teams\Teams;
use App\Support\FilterPaginateOrder;
use App\Rules\ValidAthlete;
use App\Rules\ValidTeam;
use App\Rules\ValidCoach;

class Achievements extends Model
{
    use FilterPaginateOrder;
    protected $fillable = ['name', 'description','image','level','date','coach_id','athlete_id','team_id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $filter = ['id','name', 'description','image','level','date','coach_id','athlete_id','team_id'];

    public static function initialize(){
      return [
        'name' => 'Name', 'description' => 'Description','images' => 'Image','level' => 'Level','date' => 'Date','coach_id' => "Coach", "athlete_id" => "Athlete", "team_id" => "Team"
      ];
    }

    public static function formValidation(){
      return [
        'name' => 'required|min:4|max:255',
        'description' => 'required|min:8',
        'file' => 'required|mimes:jpg,jpeg,png|max:10000|',
        'level' => 'required',
        'coach_id' => ['required', new ValidCoach],
        'athlete_id' => ['required', new ValidAthlete],
        'team_id' => ['required', new ValidTeam]
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
