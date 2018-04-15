@extends('admin/app')

@section('body_color', 'gray-bg')

@section('title','Register')

@section('main_content')
  <div class="middle-box text-center loginscreen animated fadeInDown">
      <div>
          <div>
            <h1 class="logo-name"><img style="height:180px" src="{{asset('images/logo/minar_logo.png')}}"></h1>
          </div>
          <h3>Register to Athmonior</h3>
          <p>Create account to see it in action.</p>
          <form class="m-t" role="form" method="post" id='form' action="?">
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="Name" id="input_name" name="input_name">
              </div>
              <div class="form-group">
                <select class='form-control' name="input_gender" id="input_gender">
                  <option value='man' selected>Man</option>
                  <option value='woman' >Woman</option>
                </select>
              </div>
              <div class="form-group">
                  <input type="email" class="form-control" placeholder="Email" id="input_email" name="input_email">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" id="input_username" name="input_username">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="input_password" id="input_password">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Confirmation Password" name="input_confirm_password" id="input_confirm_password">
              </div>
              <div class="form-group">
                <div class="checkbox i-checks"><label> <input id="input_checkbox" name="checkbox" type="checkbox"><i></i> Agree the terms and policy </label></div>
              </div>
              <button type="submit" name="submit" id="submit" class="btn btn-primary block full-width m-b ladda-button"  data-style="zoom-out">Register</button>

              <p class="text-muted text-center"><small>Already have an account?</small></p>
              <a class="btn btn-sm btn-white btn-block" href="{{ url('login')}}">Login</a>
          </form>
          <p class="m-t"> <small>This site made by <i class="fa fa-heart"></i> from Suitdeveloper Team <br> &copy; 2018</small> </p>
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
            input_name:{
              required: true,
              minlength: 4
            },
            input_username:{
              required: true,
              minlength: 4,
              maxlength: 20
            },
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
            input_email:{
              required: true,
              email: true
            },
            input_gender:{
              required: true
            }
          },
          submitHandler : function(form){
            l.ladda( 'start' );

            let params =  new FormData();

            params.append("fullname", $('#input_name').val());
            params.append("username", $('#input_username').val());
            params.append("password", $('#input_password').val());
            params.append("password_confirmation", $('#input_confirm_password').val());
            params.append("gender", $('#input_gender').val());
            params.append("email", $('#input_email').val());

            // Check box check
            if($('#input_checkbox').is(':checked') == false){
              swal({
                title: "Please. Try Again.",
                text: "Checkbox must be checked",
                icon: "error",
                type: "error"
              },function(isConfirm){
                l.ladda('stop');
              });
            }else{
              // Post data to controller
              /*
                _URL = define on header
                params = data
              */
              axios.post(_URL +'register',params,{
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



          }
      });

    });
  });
  </script>
@endsection
