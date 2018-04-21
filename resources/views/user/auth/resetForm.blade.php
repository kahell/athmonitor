@extends('user/dashboard')

@section('body_color', 'gray-bg')

@section('title','Reset Password')

@section('main_content')
  <div class="middle-box text-center loginscreen animated fadeInDown">
      <div>
          <div>
              <h1 class="logo-name"><img style="height:180px" src="{{asset('images/logo/minar_logo.png')}}"></h1>
          </div>
          <h3>Reset Password</h3>
          <p>Recovery your account.</p>
          <form class="m-t" role="form" method="post" id='form' action="?">
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Password" name="input_password" id="input_password">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Confirmation Password" name="input_confirm_password" id="input_confirm_password">
            </div>
            <button type="submit" name="submit" id="submit" class="btn btn-primary block full-width m-b ladda-button"  data-style="zoom-out">Send Reset Code</button>

          </form>
          <p class="m-t"> <small>This site made by <i class="fa fa-heart"></i> from Athmonior Team <br> &copy; 2018</small> </p>
      </div>
  </div>
@endsection

@section('script')
  <script>
  $(document).ready(function(){
    var l = $( '#submit' ).ladda();
    l.click(function(){
      $("#form").validate({
          rules: {
            input_password:{
              required: true,
              minlength: 6,
              maxlength: 20
            },
            input_confirm_password:{
              required: true,
              minlength: 6,
              maxlength: 20,
              equalTo: "#input_password"
            },
          },
          submitHandler : function(form){
            l.ladda( 'start' );

            let params =  new FormData();

            params.append("password", $('#input_password').val());
            params.append("password_confirmation", $('#input_confirm_password').val());
            params.append("user_id", {{ $data->user_id}});

            axios.post(_URL +'verifyPassApi',params,{
              headers:{
                'Content-Type':'application/x-www-form-urlencoded',
                'Accept' : 'application/json'
            }}).then((response)=>{
              var res = response.data;
              if(res.status == false){
                swal({
                  title: "Please. Try Again.",
                  text: res.message,
                  icon: "error",
                  type: "error"
                },function(isConfirm){
                  l.ladda('stop');
                });
              }else{
                swal({
                  title: "Success !!",
                  text: res.message,
                  type: "success"
                },function(isConfirm){
                  l.ladda('stop');
                  window.location = _URL + 'login';
                });
              }
            }).catch((error)=>{
                console.log(error.response.data)
            });

          }
      });

    });
  });
  </script>
@endsection
