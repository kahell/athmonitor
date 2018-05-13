<?php

namespace App\Http\Controllers\View\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, Session, DB, JWTAuth,JWTFactory;
use App\Model\Users\User;
use App\Model\Teams\Coaches;
use App\Model\Teams\Teams;
use App\Model\Teams\Athletes;
use App\Model\Teams\Achievements;
use App\Model\Teams\Activities;
use App\Model\Teams\Scores;
use App\Model\Sports\Position_types;
use App\Http\Controllers\View\baseViewController;

class C_dashBoard extends Controller
{
  use baseViewController;
  public function __construct()
  {
    $this->middleware('Base_View_Controller');
  }

  public function index()
  {
    $data = [
    'title' => 'User Dashboard',
    'parent_nav' => 'home',
    'child_nav' => ''
    ];
    $session = session()->all();

    $user = User::with(['status'])->findOrFail($session['user_id']);
    $coach = User::find($session['user_id'])->coach;
    $collectTeam = Teams::where('coach_id', $coach->id)->get();
    $team = Teams::where('coach_id', $coach->id)->orderBy('id', 'ASC')->first();
    $collectAthlete = [];
    if(!empty($team)){
      $athlete = Teams::find($team->id)->athlete;
      $count = 0;
      foreach ($athlete as $key) {
        $collectAthlete[$count++] = Athletes::with(['position_type'])->findOrFail($key->id);
      }
    }
    $form = Teams::initialize();
    return view('user/dashboard/d_home', compact('data','user', 'coach','collectAthlete','team', 'collectTeam','form'));
  }

  public function home($team_id)
  {
    $data = [
    'title' => 'User Dashboard',
    'parent_nav' => 'home',
    'child_nav' => ''
    ];
    $session = session()->all();

    $user = User::with(['status'])->findOrFail($session['user_id']);
    $coach = User::find($session['user_id'])->coach;
    $collectTeam = Teams::where('coach_id', $coach->id)->get();
    $team = Teams::where('id',$team_id)->first();
    $athlete = Teams::find($team_id)->athlete;
    $collectAthlete = [];
    $count = 0;
    foreach ($athlete as $key) {
      $collectAthlete[$count++] = Athletes::with(['position_type'])->findOrFail($key->id);
    }
    $form = Teams::initialize();
    return view('user/dashboard/d_home', compact('data','user', 'coach','collectAthlete','team', 'collectTeam','form'));
  }

  public function teamDetail($team_id)
  {
    $data = [
    'title' => 'User Dashboard',
    'parent_nav' => 'team',
    'child_nav' => 'detail',
    'header_title' => ''
    ];
    $session = session()->all();

    $user = User::with(['status'])->findOrFail($session['user_id']);
    $coach = User::find($session['user_id'])->coach;
    $collectTeam = Teams::where('coach_id', $coach->id)->get();
    $team = Teams::where('id',$team_id)->first();
    $athlete = Teams::find($team_id)->athlete;
    $achievement = Teams::findOrFail($team_id)->achievement;
    $collectAthlete = [];
    $count = 0;
    foreach ($athlete as $key) {
      $collectAthlete[$count++] = Athletes::with(['position_type'])->findOrFail($key->id);
    }
    $form_team = Teams::initialize();
    $form_athlete = Athletes::initialize();
    $form_achievement = Achievements::initialize();
    $position = Coaches::find($coach->id)->sport->position_type;
    $data['header_title'] = $team['name'];
    return view('user/dashboard/d_teamDetail', compact('data','user', 'coach','collectAthlete','team', 'collectTeam',
    'form_team','form_athlete','position','form_achievement','achievement'));
  }

  public function athlete($team_id, $athlete_id)
  {
    $data = [
    'title' => 'User Dashboard',
    'parent_nav' => 'team',
    'child_nav' => 'athlete',
    'header_title' => ''
    ];
    $session = session()->all();
    $user = User::with(['status'])->findOrFail($session['user_id']);
    $coach = User::find($session['user_id'])->coach;
    $collectTeam = Teams::where('coach_id', $coach->id)->get();
    $team = Teams::where('id',$team_id)->first();
    $athlete = Athletes::with(['position_type'])->findOrFail($athlete_id);
    $data['header_title'] = $athlete->fullname;
    return view('user/dashboard/d_athleteDetail', compact('data','user', 'athlete','team', 'collectTeam'));
  }

  public function monitor($team_id)
  {
    $data = [
    'title' => 'User Dashboard',
    'parent_nav' => 'monitor',
    'child_nav' => 'monitor'
    ];
    $session = session()->all();
    $user = User::with(['status'])->findOrFail($session['user_id']);
    $coach = User::find($session['user_id'])->coach;
    $collectTeam = Teams::where('coach_id', $coach->id)->get();
    $team = Teams::where('id',$team_id)->first();
    $athlete = Teams::find($team_id)->athlete;
    $collectAthlete = [];
    $count = 0;
    foreach ($athlete as $key) {
      $collectAthlete[$count++] = Athletes::with(['position_type'])->findOrFail($key->id);
    }
    $activity = Activities::where(['team_id'=> $team_id, 'status' => 1])->first();
    $formActivity = Activities::initialize();
    $parameter = Coaches::find($coach->id)->sport->parameter;
    // Check or Inserted scoring
    if($activity != null){
      $scoring = Scores::where(['activity_id' => $activity->id])->get();

      if($scoring == "[]" && $parameter != "[]"){
        foreach ($athlete as $key) { // athlete
          foreach ($parameter as $key2) { // parameter
            // Insert scores
            $scores = new Scores();
            $scores->parameter_id = $key2->id;
            $scores->value = 0;
            $scores->athlete_id = $key->id;
            $scores->activity_id = $activity->id;
            $scores->save();
          }
        }
      }else{
        if( $parameter != "[]"){
          foreach ($athlete as $key) { // athlete
            foreach ($parameter as $key2) { // parameter
              // Check thetre is parameter in scoring or not
              $count = 0;
              foreach ($scoring as $key3) {
                if($key3->parameter_id == $key2->id && $key3->athlete_id == $key->id){
                  $count = 1;
                }
              }

              if($count == 0){
                // Insert scores
                $scores = new Scores();
                $scores->parameter_id = $key2->id;
                $scores->value = 0;
                $scores->athlete_id = $key->id;
                $scores->activity_id = $activity->id;
                $scores->save();
              }

            }
          }
        }
      }
    }

    $data['header_title'] = "monitor";
    return view('user/dashboard/d_monitor', compact('data','user','collectAthlete','team', 'collectTeam','activity','formActivity','parameter'));
  }

  public function scoring($team_id, $athlete_id)
  {
    $data = [
    'title' => 'User Dashboard',
    'parent_nav' => 'monitor',
    'child_nav' => 'monitor'
    ];
    $session = session()->all();
    $user = User::with(['status'])->findOrFail($session['user_id']);
    $coach = User::find($session['user_id'])->coach;
    $collectTeam = Teams::where('coach_id', $coach->id)->get();
    $team = Teams::where('id',$team_id)->first();
    $athlete = Teams::find($team_id)->athlete;
    $collectAthlete = [];
    $count = 0;
    foreach ($athlete as $key) {
      $collectAthlete[$count++] = Athletes::with(['position_type'])->findOrFail($key->id);
    }
    $activity = Activities::where(['team_id'=> $team_id, 'status' => 1])->first();

    $scores = Scores::with(['parameter'])->where(['activity_id'=>$activity->id,'athlete_id' => $athlete_id])->get();
    $data['header_title'] = "scoring";
    return view('user/dashboard/d_scoring', compact('data','user','collectAthlete','team', 'collectTeam','activity','scores'));
  }
}
