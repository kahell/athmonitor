<?php

namespace App\Http\Controllers\View\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Users\User;
use App\Model\Users\Statuses;
use App\Model\Teams\Coaches;
use Illuminate\Support\Facades\Auth;
use Hash, Mail, Validator, Session, JWTAuth,JWTFactory;
use App\Http\Controllers\View\baseViewController;

class C_authController extends Controller
{
  use baseViewController;
  public function __construct()
  {
    $this->middleware('Base_View_Controller',['except' => ['login','register','logout','verifyUser','recover','verifyPass']]);
  }

  public function loginForm()
  {
    return view('user/auth/login');
  }

  public function registerForm()
  {
    return view('user/auth/register');
  }
  public function resetForm()
  {
    return view('user/auth/reset');
  }
  public function showResetForm($verification_code)
  {
    $status = Statuses::where('resetPassVerificationCode',$verification_code)->first();
    if(is_null($status)){
      return view('user/auth/login');
    }
    $data = User::where('user_id',$status->user_id )->first();
    return view('user/auth/resetForm',compact('data'));
  }

  public function register(Request $request)
  {
    //Validation
    $validator = Validator::make($request->all(), [
      'username' => 'required|unique:users|alpha_num|between:4,20',
      'email' => 'required|email|unique:users|max:255',
      'password' => 'required|between:6,25|confirmed',
      'fullname' => 'required|max:191',
      'gender' => 'required',
      'sport' => 'required'
    ]);

    if($validator->fails())
    {
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => $validator->errors()->first()
      ], 200);
    }

    // Initialize
    $name = $request->fullname;
    $email = $request->email;
    $verification_code = str_random(30);
    $subject = "Please verify your email address.";

    // Insert User
    $user = new User();
    $user->email = $request->email;
    $user->username = $request->username;
    $user->password = bcrypt($request->password);
    $user->fullname = $request->fullname;
    $user->gender = $request->gender;
    $user->save();

    //Insert Coaches
    $user_id = User::orderBy('id', 'desc')->first()->id;

    $coach = new Coaches();
    $coach->user_id = $user_id;
    $coach->sport_id = $request->sport;
    $coach->save();

    // Insert Statuses
    $status = new Statuses();
    $status->user_id = $user_id;
    $status->account_status_id = 2;
    $status->isBlocked = 0;
    $status->accVerificationCode = $verification_code;
    $status->isResetPass = 0;
    $status->save();

    Mail::send('email.verify', ['name' => $name, 'verification_code' => $verification_code],
    function($mail) use ($email, $name, $subject){
      $mail->from('hai@suitdevelopers.com', "Athmonior");
      $mail->to($email, $name);
      $mail->subject($subject);
    });

    return response()
    ->json([
      'status' => true,
      'data' => null,
      'message' => 'Registered Successfully!. Please confirmation your email.'
    ],200);
  }

  public function login(Request $request)
  {
    //Validation
    $validator = Validator::make($request->all(), [
      'username' => 'required',
      'password' => 'required'
    ]);

    if($validator->fails())
    {
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => $validator->errors()->first()
      ], 200);
    }

    $user = User::where('username', $request->username)->first();

    if($user && Hash::check($request->password, $user->password)){
      // Check account status ID
      $status = User::find($user->id)->status;
      if($this->checkAccount($status->account_status_id) == false){
        return response()
        ->json([
          'status' => FALSE,
          'data' => null,
          'message' => "Please verify your email address."
        ],200);
      }
      $credentials = request(['username','password']);
      $token = JWTAuth::attempt($credentials);

      Session::put(['remember_token' => $token,'user_id' => $user->id]);
      return response()
      ->json([
        'status' => true,
        'data' => [
          'token' => $token,
          'url' => 'users'
        ],
        'message' => 'Login successfully!'
      ],200);
    }

    return response()
    ->json([
      'status' => FALSE,
      'data' => null,
      'message' => 'Provided username and password does not match!'
    ],200);
  }

  public function checkAccount($status)
  {
    if($status !== "active"){
      return false;
    }
    return true;
  }

  public function verifyUser($verification_code)
  {
    $check = Statuses::where('accVerificationCode',$verification_code)->first();
    if(!is_null($check)){
      if($check->account_status_id == 1){
        return view('user/auth/login');
      }
      $check->update(['account_status_id' => 1, 'accVerificationCode' => '']);
      return view('user/auth/successEmail');
    }
    return view('user/auth/login');
  }

  public function verifyPass(Request $request)
  {
    //Validation
    $validator = Validator::make($request->all(), [
      'password' => 'required|between:6,25|confirmed',
      'user_id' => 'required'
    ]);

    if($validator->fails())
    {
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => $validator->errors()->first()
      ], 200);
    }

    $check = Statuses::where('user_id',$request->user_id)->first();
    if(!is_null($check)){
      if($check->isResetPass == 0){
        return response()->json([
          'status'=> true,
          'data' => null,
          'message'=> 'Account already verified password..'
        ]);
      }
      $user = User::where('user_id', $request->user_id)->first();
      $user->update(['password' => bcrypt($request->password) ]);
      $check->update(['isResetPass' => 0,'resetPassVerificationCode'=> '']);
      return response()->json([
        'status'=> true,
        'data' => null,
        'message'=> 'You have successfully enter new password.'
      ]);
    }
    return response()->json(['status'=> false, 'data'=>null,'message'=> "Verification Pass code is invalid."]);
  }

  public function recover(Request $request)
  {
    //Validation
    $validator = Validator::make($request->all(), [
      'email' => 'required|email|max:255'
    ]);

    if($validator->fails())
    {
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => $validator->errors()->first()
      ], 200);
    }

    $user = User::where('email', $request->email)->first();
    if (!$user) {
      $error_message = "Your email address was not found.";
      return response()->json([
        'status'=> false,
        'data' => null,
        'message' => $error_message
      ], 200);
    }
    try {
      // Initialize
      $name = $user->fullname;
      $email = $request->email;
      $verification_code = str_random(30);
      $subject = "Your Password Reset Link.";

      // Update Statuses
      $status = Statuses::where('user_id', $user->user_id)->first();
      $status->update(['isResetPass' => 1,'resetPassVerificationCode' => $verification_code]);

      Mail::send('email.reset', ['name' => $name, 'verification_code' => $verification_code],
      function($mail) use ($email, $name, $subject){
        $mail->from('hai@suitdevelopers.com', "Suitdeveloper");
        $mail->to($email, $name);
        $mail->subject($subject);
      });
    } catch (\Exception $e) {
      //Return with error
      $error_message = $e->getMessage();
      return response()->json(['status'=> false,'data' => null, 'message' => $error_message], 401);
    }
    return response()->json([
      'status' => true, 'data'=> null, 'message'=> 'A reset email has been sent! Please check your email.'
    ],200);
  }

  public function me()
  {
    return response()->json(auth()->user());
  }

  public function logout()
  {
    $session = Session::get('remember_token');
    // $user = User::where('remember_token', $session)->first();
    // $user->remember_token = '';
    // $user->save();
    Session::pull('remember_token');
    return redirect('/');
  }

  public function refresh()
  {
    return $this->respondWithToken(auth()->refresh());
  }

  public function payload()
  {
    return auth()->payload();
  }
}
