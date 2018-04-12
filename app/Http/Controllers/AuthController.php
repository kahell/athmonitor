<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\user\User;
use App\Model\user\Statuses;
use Illuminate\Support\Facades\Auth;
use Hash, Mail, Validator;
use Illuminate\Mail\Message;

class AuthController extends Controller
{
    public function __construct()
    {
      $this->middleware('jwt',['except' => ['login','register','logout','verifyUser']]);
    }

    public function register(Request $request)
    {
      $this->validate($request, [
        'username' => 'required|unique:users|alpha_num|between:4,20',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|between:6,25|confirmed',
        'fullname' => 'required|max:191',
        'gender' => 'required|numeric',
      ]);

      // Initialize
      $name = $request->fullname;
      $email = $request->email;
      $verification_code = str_random(30);
      $subject = "Please verify your email address.";

      $user = new User($request->all());
      $user->role_id = 1;
      $user->password = bcrypt($request->password);
      $user->save();

      // Insert Statuses
      $status = new Statuses();
      $status->user_id = User::orderBy('user_id', 'desc')->first()->user_id;
      $status->account_status_id = 2;
      $status->isBlocked = 0;
      $status->accVerificationCode = $verification_code;
      $status->isResetPass = 0;
      $status->save();

      Mail::send('email.verify', ['name' => $name, 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from('hai@suitdevelopers.com', "Suitdeveloper");
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
        'password' => 'required|between:6,25'
      ]);

      if($validator->fails())
      {
        return response()->json([
          'status'=> false,
          'data' => null,
          'message' => $validator->errors()->first()
        ], 200);
      }

      $user = User::where('username', $request->username)
        ->first();

      if($user && Hash::check($request->password, $user->password)){
        $user->save();

        $credentials = request(['username','password']);
        $token = auth()->attempt($credentials);
        return response()
          ->json([
            'status' => true,
            'data' => [
              'token' => $token,
              'url' => 'admin'
              ]
          ]);
      }

      return response()
        ->json([
          'status' => FALSE,
          'data' => null,
          'message' => ['Provided username and password does not match!']
        ],422);
    }

    public function verifyUser($verification_code)
    {
        $check = Statuses::where('accVerificationCode',$verification_code)->first();
        if(!is_null($check)){
            if($check->account_status_id == 1){
                return response()->json([
                    'status'=> true,
                    'data' => null,
                    'message'=> 'Account already verified..'
                ]);
            }
            $check->update(['account_status_id' => 1]);
            Statuses::where('accVerificationCode',$verification_code)->delete();
            return response()->json([
                'status'=> true,
                'data' => null,
                'message'=> 'You have successfully verified your email address.'
            ]);
        }
        return response()->json(['status'=> false, 'data'=>null,'message'=> "Verification code is invalid."]);
    }

    public function recover(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $error_message = "Your email address was not found.";
            return response()->json(['success' => false, 'error' => ['email'=> $error_message]], 401);
        }
        try {
            Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject('Your Password Reset Link');
            });
        } catch (\Exception $e) {
            //Return with error
            $error_message = $e->getMessage();
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
        return response()->json([
            'success' => true, 'data'=> ['message'=> 'A reset email has been sent! Please check your email.']
        ]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
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
