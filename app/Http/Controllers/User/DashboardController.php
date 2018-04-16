<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, Session, DB;
use App\Model\user\User;
use App\Model\user\Coaches;
use App\Model\user\Teams;
use App\Model\user\Athletes;
use App\Model\user\Position_types;

class DashboardController extends Controller
{

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
    $coach = Coaches::with(['user','status','team','sport','achievement'])->findOrFail($session['remember_token']);
    $team = Teams::where('team_id', $coach['team'][0]->team_id)->first();
    $teamId = $coach['team'][0]->team_id;
    $athlete = DB::table('athletes')
    ->select('athletes.athlete_id','athletes.fullname','athletes.gender','athletes.player_status','athletes.player_number',
    'position_types.name as position_types')
    ->join('position_types','position_types.position_type_id','=','athletes.position_type_id')
    ->where(['athletes.team_id' => $coach['team'][0]->team_id])
    ->get();
    return view('user/dashboard/d_home', compact('data','coach', 'athlete','team'));
  }

  public function home($team_id)
  {
    $data = [
    'title' => 'User Dashboard',
    'parent_nav' => 'home',
    'child_nav' => ''
    ];
    $session = session()->all();
    $coach = Coaches::with(['user','status','team','sport','achievement'])->findOrFail($session['remember_token']);
    $team = Teams::where('team_id', $team_id)->first();
    $athlete = DB::table('athletes')
    ->select('athletes.athlete_id','athletes.fullname','athletes.gender','athletes.player_status','athletes.player_number',
    'position_types.name as position_types')
    ->join('position_types','position_types.position_type_id','=','athletes.position_type_id')
    ->where(['athletes.team_id' => $team_id])
    ->get();
    return view('user/dashboard/d_home', compact('data','coach', 'athlete','team'));
  }

  public function team()
  {
    $data = [
    'title' => 'User Dashboard',
    'parent_nav' => 'team',
    'child_nav' => 'team'
    ];
    $session = session()->all();
    $user = User::where('remember_token',$session['remember_token'])->first();
    $coach = Coaches::where('user_id', $user['user_id'])->first();
    $team = Teams::where('coach_id', $coach['coach_id']);
    return view('user/dashboard/d_team', compact('data','user'));
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
    $coach = Coaches::with(['user','status','team','sport','achievement'])->findOrFail($session['remember_token']);
    $team = Teams::where('team_id', $team_id)->first();
    $athlete = DB::table('athletes')
    ->select('athletes.athlete_id','athletes.fullname','athletes.gender','athletes.avatar','athletes.phone_number','athletes.player_status','athletes.player_number',
    'position_types.name as position_types')
    ->join('position_types','position_types.position_type_id','=','athletes.position_type_id')
    ->where(['athletes.team_id' => $team_id])
    ->get();

    $data['header_title'] = $team['name'];
    return view('user/dashboard/d_teamDetail', compact('data','coach','team','athlete'));
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
    $coach = Coaches::with(['user','status','team','sport','achievement'])->findOrFail($session['remember_token']);
    // echo json_encode($coach['user']->username);exit;
    $team = Teams::where('team_id', $team_id)->first();
    $athlete = DB::table('athletes')
    ->select('athletes.athlete_id','athletes.fullname','athletes.gender','athletes.bod', 'athletes.address',
    'athletes.avatar','athletes.phone_number','athletes.player_status','athletes.player_number',
    'position_types.name as position_types')
    ->join('position_types','position_types.position_type_id','=','athletes.position_type_id')
    ->where(['athletes.athlete_id' => $athlete_id])
    ->get();
    $data['header_title'] = $athlete[0]->fullname;
    return view('user/dashboard/d_athleteDetail', compact('data','team', 'coach','athlete'));
  }

  public function monitor($team_id)
  {
    $data = [
    'title' => 'User Dashboard',
    'parent_nav' => 'monitor',
    'child_nav' => 'monitor'
    ];
    $session = session()->all();
    $coach = Coaches::with(['user','status','team','sport','achievement'])->findOrFail($session['remember_token']);
    // echo json_encode($coach['user']->username);exit;
    $team = Teams::where('team_id', $team_id)->first();
    $athlete = DB::table('athletes')
    ->select('athletes.athlete_id','athletes.fullname','athletes.gender','athletes.bod', 'athletes.address',
    'athletes.avatar','athletes.phone_number','athletes.player_status','athletes.player_number',
    'position_types.name as position_types')
    ->join('position_types','position_types.position_type_id','=','athletes.position_type_id')
    ->where(['athletes.team_id' => $team_id])
    ->get();
    return view('user/dashboard/d_monitor', compact('data','team', 'coach','athlete'));
  }
}
