@extends('admin/app')

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
              <input type="email" class="form-control" placeholder="Email" id="input_email" name="input_email">
            </div>
            <button type="submit" name="submit" id="submit" class="btn btn-primary block full-width m-b ladda-button"  data-style="zoom-out">Send Reset Code</button>
            <p class="text-muted text-center"><small>Already have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="{{ url('login')}}">Login</a>
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
            'input_email':{
              required: true,
              email: true
            }
          },
          submitHandler : function(form){
            l.ladda( 'start' );

            let params =  new FormData();

            params.append("email", $('#input_email').val());

            axios.post(_URL +'recoverApi',params,{
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
