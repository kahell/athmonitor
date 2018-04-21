@extends('user/dashboard')

@section('body_color', 'gray-bg')

@section('title','Verification Email')

@section('main_content')
  <div class="middle-box text-center loginscreen animated fadeInDown">
      <div>
          <div>
              <h1 class="logo-name"><img style="height:180px" src="{{asset('images/logo/minar_logo.png')}}"></h1>
          </div>
          <h3>Verification.</h3>
          <p>Verification email successfully!</p>
          <a type="btn" href="{{url('/')}}" class="btn btn-primary block full-width m-b">
            Home
          </a>
          <p class="m-t"> <small>This site made by <i class="fa fa-heart"></i> from Athmonior Team <br> &copy; 2018</small> </p>
      </div>
  </div>
@endsection
