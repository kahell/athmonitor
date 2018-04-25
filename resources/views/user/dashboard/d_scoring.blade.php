@extends('user/dashboard')

@section('title','Dashboard User')

@section('css-style')
  <style>
  .noUi-tooltip {
    display: none;
  }
  .noUi-active .noUi-tooltip {
    display: block;
  }
  </style>
@endsection

@section('main_content')
  <div id="wrapper">
    @include('user/layouts_dashboard/ud_sidebar_nav_dashboard')

    <div id="page-wrapper" class="gray-bg dashbard-1">
      @include('user/layouts_dashboard/ud_top_nav_dashboard')
      @include('user/layouts_dashboard/ud_header_title_dashboard')
      <div class="wrapper wrapper-content">
        @if ($activity != null)
          <div class="row">
              <div class="col-lg-12">

                <div class="ibox float-e-margins">
                  @if($scores != "[]")
                    <div class="ibox-title">
                      <h5>Parameter <small>Please enter all related data.</small></h5>
                      <div class="ibox-tools">
                        <a class="collapse-link">
                          <i class="fa fa-chevron-up"></i>
                        </a>
                      </div>
                    </div>
                    <div class="ibox-content">
                      <div class="row">
                        <div class="col-lg-12">
                          <form id="form" role="form" class="form-horizontal">
                            @foreach ($scores as $key)
                              <div class="form-group"><label class="col-sm-2 control-label" >{{$key->parameter->name}}</label>
                                <div class="col-sm-10">
                                  <div id="input_{{$key->id}}" name="input_{{$key->id}}"></div>
                                  <div id="slider"></div>
                                </div>
                              </div>
                            @endforeach
                            <div class="pull-right">
                              <a href="{{url('users/'.$team['id'].'/monitor')}}" class="btn btn-white" type="submit">Cancel</a>
                              <button class="ladda-button btn btn-primary" id="submit" type="submit" data-style="zoom-out">Submit</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  @else
                    <div class="ibox-title">
                      <div style='text-align: center'>
                        <h3>No Paramter Data</h3>
                        <p>Please contact admin to report this error message.</p>
                        <a href="{{ url('users/'.$team['id'].'/monitor')}}" class="btn btn-primary">Back to monitor</a>
                      </div>
                    </div>
                  @endif
                </div>

              </div>
          </div>
        @endif

      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
  $(document).ready(function() {
    var slider = [];
    var scoreId = [];

    var count = 0;

    @foreach ($scores as $key)
    slider[count] = document.getElementById('input_{{$key->id}}');
    scoreId[count] = "{{$key->id}}";
    noUiSlider.create(slider[count], {
    	start: {{$key->value}},
      direction: 'ltr',
    	connect: [true,false],
      behaviour: 'tap-drag',
	    tooltips: true,
    	range: {
    		'min': 0,
    		'max': 10
    	}
    });
    count++;
    @endforeach

    var l = $( '#submit' ).ladda();
    l.click(function(){
      $("#form").validate({
          rules: {
            @foreach ($scores as $key)
            'input_{{$key->id}}':{
              required: true
            },
            @endforeach
          },
          submitHandler : function(form){
            l.ladda( 'start' );

            var params = new FormData();
            var url = _URL + "api/scores/input";
            params.append("athlete_id", '{{$scores[0]->athlete_id}}');
            var score_id = "";
            var values = "";
            for (var i = 0; i < slider.length; i++) {
              score_id = score_id + scoreId[i] + ',';
              values = values + slider[i].noUiSlider.get() + ',';
            }
            params.append("score_id", score_id);
            params.append("values", values);

            axios.post(url,params,{
              headers:headers
            }).then(function(response){
              res = response.data;
              //if response success
              if(res.status == false){
                swal({
                  title: "Please. Try Again.",
                  text: res.message,
                  icon: "error",
                  type: "error"
                },function(isConfirm){
                  l.ladda('stop');
                  // $('#modal').modal('hide');
                });
              }else{

                swal({
                  title: "Success",
                  text: res.message,
                  type: "success"
                },function(isConfirm){
                  l.ladda('stop');
                  // $('#modal').modal('hide');
                  window.location = _URL + "users/{{$team['id']}}/monitor/";
                });
              }
            }).catch(function(error){
              console.log(error);
              //swal of error
            });

          }
      });
    });

  });

  </script>
@endsection
