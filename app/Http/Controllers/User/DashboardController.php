<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, Session;
use App\Model\user\User;
use App\Model\user\Coaches;
use App\Model\user\Teams;
use App\Model\user\Athletes;

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
    $user = User::where('remember_token',$session['remember_token'])->first();
    return view('user/dashboard/d_home', compact('data','user'));
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

  public function teamDetail(Request $request)
  {
    $data = [
    'title' => 'User Dashboard',
    'parent_nav' => 'team',
    'child_nav' => 'detail',
    'header_title' => ''
    ];
    $team = Teams::where('team_id',$request->team)->first();
    $session = session()->all();
    $user = User::where('remember_token',$session['remember_token'])->first();
    $coach = Coaches::where('user_id', $user->user_id)->first();

    $data['header_title'] = $team['name'];
    return view('user/dashboard/d_teamDetail', compact('data','user', 'team', 'coach'));
  }

  public function athlete($team_id, $athlete_id)
  {
    $data = [
    'title' => 'User Dashboard',
    'parent_nav' => 'team',
    'child_nav' => 'athlete',
    'header_title' => ''
    ];
    $team = Teams::where('team_id',$team_id)->first();
    $session = session()->all();
    $user = User::where('remember_token',$session['remember_token'])->first();
    $coach = Coaches::where('user_id', $user->user_id)->first();
    $athlete = Athletes::where('athlete_id', $athlete_id)->first();
    $data['header_title'] = $athlete['fullname'];
    return view('user/dashboard/d_athleteDetail', compact('data','user','team', 'coach'));
  }
}
