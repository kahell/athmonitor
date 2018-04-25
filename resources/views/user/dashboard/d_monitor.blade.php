@extends('user/dashboard')

@section('title','Dashboard User')

@section('main_content')
  <div id="wrapper">
    @include('user/layouts_dashboard/ud_sidebar_nav_dashboard')

    <div id="page-wrapper" class="gray-bg dashbard-1">
      @include('user/layouts_dashboard/ud_top_nav_dashboard')
      @include('user/layouts_dashboard/ud_header_title_dashboard')
      <div class="wrapper wrapper-content">
        @if ($activity != null)
          <div class="ibox-content m-b-sm border-bottom">

              <div class="row">
                  <div class="col-sm-2">
                      <div class="form-group">
                          <label class="control-label" for="product_name">Date</label>
                          <p>{{$activity->time}}</p>
                      </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="form-group">
                          <label class="control-label" for="price">Place</label>
                          <p>{{$activity->place}}</p>
                      </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="form-group">
                          <label class="control-label" for="quantity">Type</label>
                          <p>{{$activity->type}}</p>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="form-group">
                          <label class="control-label" for="status">Status</label>
                          @if ($activity->status == "active")
                            <p><span class='label label-primary'>Active</span></p>
                          @else
                            <p><span class='label label-default'>In-Active</span></p>
                          @endif
                      </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label class="control-label" for="status">End this Activity</label>
                      <button class="ladda-button btn btn-primary" id="end-activity" type="end-activity" data-style="zoom-out">End Activity</button>
                    </div>
                  </div>
              </div>

          </div>
        @endif

        <div class="row">
          <div class="col-lg-12">
            <div class="ibox">
              <div class="ibox-title">
                <h5>Your Players</h5>
              </div>
              <div class="ibox-content">
                @if ($activity == null)
                  <div style='text-align: center'>
                    <h3>No Activity Data</h3>
                    <a href="#" id="add-activity-button" class="btn btn-primary">Add activity</a>
                  </div>
                @else
                  <div class="table-responsive">
                    <table id="scores_table" class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                      <thead>
                        <tr>
                          <th data-toggle="true">Avatar</th>
                          <th>Name</th>
                          <th data-hide="phone">Gender</th>
                          <th data-hide="all">Position</th>
                          <th data-hide="phone">Status</th>
                          <th class="text-right" data-sort-ignore="true">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($collectAthlete as $key)
                          <tr>
                            <td data-value='{{$key->avatar}}'></td>
                            <td data-value='{{$key->fullname}}'></td>
                            <td data-value='{{$key->gender}}'></td>
                            <td data-value='{{$key->position_type->name}}'></td>
                            <td data-value='{{$key->scoring_status}}'></td>
                            <td data-value='{{$key->id}}' class="text-right"></td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                @endif

              </div>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal inmodal" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-plus-square modal-icon"></i>
                        <h4 class="modal-title">Add new Activity</h4>
                        <small class="font-bold">Please fill all related field.</small>
                    </div>
                    <form role="form" id="form" >
                      <div class="modal-body">
                        <!-- Form activity -->
                          @foreach ($formActivity as $key => $value)
                            <div class="form-group" id="form_{{$key}}">
                              <label>{{ucfirst($key)}}</label>
                              @if ($key === "status")
                                <select id="input_{{ $key }}" name="input_{{ $key }}" class="form-control">
                                  <option value='active' selected>Active</option>
                                  <option value='inactive' >In-active</option>
                                </select>
                              @elseif ($key === "type")
                                <select id="input_{{ $key }}" name="input_{{ $key }}" class="form-control">
                                  <option value='exercise' selected>Exercise</option>
                                  <option value='sparing' >Sparing</option>
                                  <option value='championship' >Championship</option>
                                </select>
                              @elseif ($key === "time")
                                <div class="input-group date">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  <input id="input_{{ $key }}" name="input_{{ $key }}" type="text" class="form-control" placeholder="Enter {{ $key }}">
                                </div>
                              @elseif ($key === "team_id")
                                <input id="input_{{ $key }}" name="input_{{ $key }}" type="text" placeholder="Enter {{ $key }}" value="{{ $team['id'] }}" class="form-control" disabled>
                              @else
                                <input id="input_{{ $key }}" name="input_{{ $key }}" type="text" placeholder="Enter {{ $key }}" class="form-control">
                              @endif
                            </div>
                          @endforeach
                        <!-- End of Form activity -->
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                          <button class="ladda-button btn btn-primary" id="submit" type="submit" data-style="zoom-out">Submit</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End of Modal -->

      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
  // initialize
  var rules = [];

  $(document).ready(function() {
    // Date
    $('#form_time .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
    row = FooTable.getRow(this);
    ft = FooTable.init('#scores_table', {
      "columns": [
        {name: "avatar",
          formatter: function(value){
             if (value){
               return '<td class="client-avatar"><img class="img-responsive" src="'+_URL+"storage/"+value+'"/><td>';
             }
             return "";
           }
        },
        {name: "name"},
        {name: "gender"},
        {name: "position_type"},
        {name: "status",
          formatter: function(value){
            if (value == "done"){
              return '<span class="label label-primary">Done</span>';
            }else if (value == "unscoring") {
              return '<span class="label label-danger">Un-Scoring</span>';
            }
            return "";
          }
        },
        {name: "id",
          formatter: function(value){
            if (value){
              return "<td class='text-right'>"
              +"<div class='btn-group'>"
              +"<a href='"+_URL+'users/{{$team['id']}}/monitor/'+value+"' class='btn-white btn btn-xs'>Edit</a>"
              +"</div>"
              +"</td>";
            }
            return "";
          }
        },
      ],
      "rows": row,
      "filtering": {
        "enabled": true
      },
      "paging": {
        "enabled": true
      },
      "state": {
        "paging": false
      }
    });

    $('#add-activity-button').click(function(e){
       e.preventDefault();
       $('.fa-plus-square').show();
       rules = [];
       rules = {
         'input_name':{
           required: true,
           minlength: 4
         },
         'input_time':{
           required: true,
           date: true
         },
         'input_place':{
           required: true,
           minlength: 4
         },
         'input_type':{
           required: true,
         },
         'input_status':{
           required: true,
         }
       };
       $('#modal').modal({backdrop: 'static', keyboard: false});
       $('#modal').modal('show');
    });

    $('#end-activity').click(function(e){
       e.preventDefault();
       swal({
              title: "Are you sure?",
              text: "Make sure you are already input your team.",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, I sure!",
              closeOnConfirm: false
          }, function (value) {
            if(value == true){
              var params = new FormData();
              var url = _URL + "api/activities/update/{{$activity['id']}}";
              params.append('status', 'inactive');
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
                    $('#modal').modal('hide');
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

    var l = $( '#submit' ).ladda();
    l.click(function(){
      $("#form").validate({
          rules: rules,
          submitHandler : function(form){
            l.ladda( 'start' );

            var params = new FormData();
            var url = _URL + "api/activities";
            params.append("team_id", $('#input_team_id').val());
            params.append("time", $('#input_time').val());
            params.append("place", $('#input_place').val());
            params.append("type", $('#input_type').val());
            params.append("status", $('#input_status').val());

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
                  $('#modal').modal('hide');
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
