@extends('user/dashboard')

@section('body_color', 'gray-bg')

@section('title','Sign In')

@section('main_content')
  <div class="middle-box text-center loginscreen animated fadeInDown">
      <div>
          <div>
              <h1 class="logo-name"><img style="height:180px" src="{{asset('images/logo/minar_logo.png')}}"></h1>
          </div>
          <h3>Welcome to Athmonior</h3>
          <p>Managing your teams to the next level.
              <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
          </p>
          <p>Login in. To see it in action.</p>
          <form class="m-t" role="form" method="post" id='form' action="?">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Username" id="input_username" name="input_username">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Password" name="input_password" id="input_password">
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-primary block full-width m-b ladda-button"  data-style="zoom-out">Login</button>
            <a href="{{url('reset')}}"><small>Forgot password?</small></a>
            <p class="text-muted text-center"><small>Do not have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="{{url('register')}}">Create an account</a>
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
            'input_username':{
              required: true,
            },
            'input_password':{
              required: true,
            }
          },
          submitHandler : function(form){
            l.ladda( 'start' );

            let params =  new FormData();

            params.append("username", $('#input_username').val());
            params.append("password", $('#input_password').val());

            axios.post(_URL +'loginApi',params,{
                headers:{
                    'Content-Type':'application/x-www-form-urlencoded'
                }
            }).then((response)=>{
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
                  localStorage.setItem('token', res.data.token);
                  window.location = _URL + res.data.url;
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
