@extends('user/dashboard')

@section('title','Dashboard User')

@section('css-style')
  <style>
  .footable .btn-primary {
    color: #fff;
    background-color: #1ab394;
    border-color: #1ab394;
  }
  .footable .btn-primary:hover {
    color: #fff;
    background-color: #18a689;
    border-color: #18a689;
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
        <div class="row">
          <div class="col-lg-9">
            <div class="wrapper wrapper-content animated fadeInUp">
              <div class="ibox">
                <div class="ibox-content">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="m-b-md">
                        <a href="#" id="edit-team-button" class="btn btn-white btn-xs pull-right">Edit team</a>
                        <h2>Team</h2>
                      </div>
                      {{-- <dl class="dl-horizontal">
                        <dt>Status:</dt>
                        <dd>
                          @if ($user->status->name === "active")
                            <span class='label label-primary'>Active</span>
                          @else
                            <span class='label label-default'>In-active</span>
                          @endif
                        </dd>
                      </dl> --}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-5">
                      <dl class="dl-horizontal">

                        <dt>Coach:</dt> <dd>{{$user['fullname']}}</dd>
                        <dt>Address:</dt> <dd id="updated_team_address">  {{$team['address']}}</dd>
                      </dl>
                    </div>
                    <div class="col-lg-7" id="cluster_info">
                      <dl class="dl-horizontal" >

                        <dt>City:</dt> <dd id="updated_team_city">  {{$team['city']}}</dd>
                        <dt>Province:</dt> <dd id="updated_team_province"> {{$team['province']}}</dd>
                        <dt>Created Team:</dt> <dd> {{$team['created_at']}}</dd>
                      </dl>
                    </div>
                  </div>
                  <div class="row m-t-sm">
                    <div class="col-lg-12">
                      <div class="panel blank-panel">
                        <div class="panel-heading">
                          <div class="panel-options">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#tab-1" data-toggle="tab">Athletes</a></li>
                              <li class=""><a href="#tab-2" data-toggle="tab">Achievement</a></li>
                            </ul>
                          </div>
                        </div>

                        <div class="panel-body">

                          <div class="tab-content">
                            <div class="tab-pane active" id="tab-1">
                              @if (empty($collectAthlete))
                                <div style='text-align: center'>
                                  <img style='width:150px;' src='{{ asset('images/logo/minar_logo.png') }}' />
                                  <h3>NO DATA IN ATHLETE</h3>
                                </div>
                              @else
                                <div class="table-responsive">
                                  <table class="footable table table-stripped" id="athlete_table" data-paging="true" data-page-size="10" data-filtering="true" data-sorting="true" data-editing-allow-edit="false">
                                    <thead>
                                      <tr>
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Position</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($collectAthlete as $key)
                                        <tr>
                                          <td class="client-avatar" data-value='{{$key->avatar}}'></td>
                                          <td><a href="{{url('users/'.$team['id'].'/athlete/'.$key->id)}}" class="client-link" aria-expanded="true">{{$key->fullname}}</a></td>
                                          <td> {{$key->gender}}</td>
                                          <td> {{$key->position_type->name}}</td>
                                          <td data-value='{{$key->phone_number}}'></td>
                                          <td class="client-status" data-value='{{$key->player_status}}'>
                                          </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>
                              @endif
                            </div>
                            <div class="tab-pane" id="tab-2">

                                <div class="table-responsive">
                                  <table class="footable table table-stripped" id="achievement_table" data-paging="true" data-filtering="true" data-sorting="true" data-editing-allow-edit="false">
                                    <thead>
                                      <tr>
                                        <th>Level</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Time</th>
                                        <th>Description</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($achievement as $key)
                                        <tr>
                                          <td data-value='{{$key->level}}'></td>
                                          <td class="client-avatar" data-value='{{$key->images}}'></td>
                                          <td data-value='{{$key->name}}'></td>
                                          <td data-value='{{$key->date}}'></td>
                                          <td data-value='{{$key->description}}'></td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                                </div>

                            </div>
                          </div>

                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="wrapper wrapper-content project-manager">
              <h4 id="updated_team_name">{{ $team['name']}}</h4>
              <img id="updated_team_image" src="{{ (empty($team['avatar']))? asset('images/profile_small.jpg') : asset('storage/'.$team['avatar'])}}" class="img-responsive">
              <br>
              <p id="updated_team_description" class="small">
                {{ $team['description']}}
              </p>
              <p class="small font-bold">
                {{-- <span><i class="fa fa-circle text-green"></i> Active</span> --}}
              </p>
              <div class="text-center m-t-md">
                <a href="#" id="add-athlete-button" class="btn btn-xs btn-primary">Add Athlete</a>
                <a href="#" id="add-achievement-button" class="btn btn-xs btn-primary">Add Achievement</a>
              </div>
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
                      <i class="fa fa-edit modal-icon"></i>
                      <h4 class="modal-title" id="modal_title">Edit team</h4>
                      <small class="font-bold">Please fill all related field.</small>
                  </div>
                  <form role="form" id="form">
                    <div class="modal-body">
                       <!-- Form for team -->
                        @foreach ($form_team as $key => $value)
                          <div class="form-group" id="form_{{$key}}">
                            <label>{{ucfirst($key)}}</label>
                            @if ($key === "avatar")
                              <input id="input_{{ $key }}" name="input_{{ $key }}" type="file" class="form-control">
                            @elseif ($key === "description")
                              <textarea id="input_{{ $key }}" name="input_{{ $key }}" placeholder="Enter {{ $key }}" class="form-control">{{$team['description']}}</textarea>
                            @elseif ($key === "address")
                              <textarea id="input_{{ $key }}" name="input_{{ $key }}" placeholder="Enter {{ $key }}" class="form-control">{{ $team['address']}}</textarea>
                            @elseif ($key === "coach_id")
                              <input id="input_{{ $key }}" name="input_{{ $key }}" type="text" placeholder="Enter {{ $key }}" value="{{ $team['coach_id'] }}" class="form-control" disabled>
                            @elseif ($key == "name")
                              <input id="input_{{ $key }}" name="input_{{ $key }}" type="text" placeholder="Enter {{ $key }}" value="{{ $team['name'] }}" class="form-control">
                            @elseif ($key === "province")
                              <input id="input_{{ $key }}" name="input_{{ $key }}" type="text" placeholder="Enter {{ $key }}" value="{{ $team['province'] }}" class="form-control">
                            @elseif ($key === "city")
                              <input id="input_{{ $key }}" name="input_{{ $key }}" type="text" placeholder="Enter {{ $key }}" value="{{ $team['city'] }}" class="form-control">
                            @endif
                          </div>
                        @endforeach
                        <!-- End of team -->

                        <!-- Form for athlete -->
                        @foreach ($form_athlete as $key => $value)
                          @if ($key != "player_status_activity")
                            <div class="form-group" id="form_player_{{$key}}">
                              <label>{{ucfirst($value)}}</label>
                              @if ($key === "avatar")
                                <input id="input_player_{{ $key }}" name="input_player_{{ $key }}" type="file" class="form-control">
                              @elseif ($key === "description")
                                <textarea id="input_player_{{ $key }}" name="input_player_{{ $key }}" placeholder="Enter {{ $key }}" class="form-control"></textarea>
                              @elseif ($key === "address")
                                <textarea id="input_player_{{ $key }}" name="input_player_{{ $key }}" placeholder="Enter {{ $key }}" class="form-control"></textarea>
                              @elseif ($key == "gender")
                                <select id="input_player_{{ $key }}" name="input_player_{{ $key }}" class="form-control">
                                  <option value='man' selected>Man</option>
                                  <option value='woman' >Woman</option>
                                </select>
                              @elseif ($key === "position_type_id")
                                <select id="input_player_{{ $key }}" name="input_player_{{ $key }}" class="form-control">
                                  <option value='null' selected>Please select position</option>
                                  @foreach ($position as $key)
                                    <option value='{{$key->id}}'>{{$key->name}}</option>
                                  @endforeach
                                </select>
                              @elseif ($key === "player_status")
                                <select id="input_player_{{ $key }}" name="input_player_{{ $key }}" class="form-control">
                                  <option value='active' selected>Active</option>
                                  <option value='inactive' >In-Active</option>
                                </select>
                              @elseif ($key === "bod")
                                <div class="input-group date">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  <input id="input_player_{{ $key }}" name="input_player_{{ $key }}" type="text" class="form-control" placeholder="Enter {{ $key }}">
                                </div>
                              @elseif ($key === "team_id")
                                <input id="input_player_{{ $key }}" name="input_player_{{ $key }}" type="text" placeholder="Enter {{ $key }}" value="{{ $team['id'] }}" class="form-control" disabled>
                              @else
                                <input id="input_player_{{ $key }}" name="input_player_{{ $key }}" type="text" placeholder="Enter {{ $key }}" class="form-control">
                              @endif
                            </div>
                          @endif
                        @endforeach
                        <!-- End of Athlete -->

                        <!-- Form for achievement -->
                        @foreach ($form_achievement as $key => $value)
                          @if ($key !== "coach_id" && $key !== "athlete_id")
                            <div class="form-group" id="form_achievement_{{$key}}">
                              <label>{{ ($key == "team_id")? "Achievement" : ucfirst($value)}}</label>
                              @if ($key == "description")
                                <textarea id="input_achievement_{{ $key }}" name="input_achievement_{{ $key }}" placeholder="Enter {{ $key }}" class="form-control"></textarea>
                              @elseif ($key == "images")
                                <input id="input_achievement_{{ $key }}" name="input_achievement_{{ $key }}" type="file" class="form-control">
                              @elseif ($key == "level")
                                <select id="input_achievement_{{ $key }}" name="input_achievement_{{ $key }}" class="form-control">
                                  <option value='local' selected>Local</option>
                                  <option value='regional' >Regional</option>
                                  <option value='national' >National</option>
                                  <option value='international' >International</option>
                                </select>
                              @elseif ($key == "team_id")
                                <select id="input_achievement_{{ $key }}" name="input_achievement_{{ $key }}" class="form-control">
                                  <option value='{{ $team['id']}}'  selected> {{$team['name']}}</option>
                                </select>
                              @elseif ($key == "date")
                                <div class="input-group date">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  <input id="input_achievement_{{ $key }}" name="input_achievement_{{ $key }}" type="text" class="form-control" placeholder="Enter {{ $key }}">
                                </div>
                              @else
                                <input id="input_achievement_{{ $key }}" name="input_achievement_{{ $key }}" type="text" placeholder="Enter {{ $key }}" class="form-control">
                              @endif
                            </div>
                          @endif
                        @endforeach
                        <!-- End of achievement -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button class="ladda-button btn btn-primary" id="submit" type="submit" data-style="zoom-out">Save changes</button>
                    </div>
                  </form>
              </div>
          </div>
      </div>
      <!-- End of Modal -->
    </div>
  </div>
@endsection

@section('script')
  <script>
  $(document).ready(function() {
    var modalValue = 1;
    var rules = [];
    // Date
    $('#form_player_bod .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    $('#form_achievement_date .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    // Footable for athletes
    row = FooTable.getRow(this);
    ft = FooTable.init('#athlete_table', {
      "columns": [
        {name: "avatar",
         formatter: function(value){
            if (value){
              return '<td class="client-avatar"><img class="img-responsive" src="'+_URL+"storage/"+value+'"/><td>';
            }
            return "";
          }
        },
        {name: "fullname"},
        {name: "gender"},
        {name: "position_type"},
        {name: "phone_number",
          formatter: function(value){
            if (value){
              return '<td><i class="fa fa-phone"></i> '+value+'<td>';
            }
             return "";
           }
        },
        {name: "player_status",
          formatter: function(value){
            if (value == "active"){
              return '<td class="client-avatar"><span class="label label-primary">Active</span><td>';
            }else if (value == "inactive") {
              return '<td class="client-avatar"><span class="label label-default">In-active</span><td>';
            }
             return "";
           }
        },
      ],
      "rows": row,
      "filtering": {
        "enabled": false
      },
      "paging": {
        "enabled": true
      },
      "state": {
        "paging": false
      }
    });

    // Footable for achievement
    rowAchievement = FooTable.getRow(this);
    ftAchievement = FooTable.init('#achievement_table', {
      "columns": [
        {name: "level",
         formatter: function(value){
            if (value == "local"){
              return '<td><span class="label label-default">'+value+'</span><td>';
            }else if (value == "regional") {
              return '<td><span class="label label-primary">'+value+'</span><td>';
            }else if (value == "national") {
              return '<td><span class="label label-warning">'+value+'</span><td>';
            }else if (value == "international") {
              return '<td><span class="label label-danger">'+value+'</span><td>';
            }
            return "";
          }
        },
        {name: "images",
         formatter: function(value){
            if (value){
              return '<td class="client-avatar"><img class="img-responsive" src="'+_URL+"storage/"+value+'"/><td>';
            }
            return "";
          }
        },
        {name: "name"},
        {name: "date"},
        {name: "description",
          formatter: function(value){
             if (value){
               return '<td><p class="small">'+value+'</p><td>';
             }
             return "";
           }
        },
      ],
      "rows": rowAchievement,
      "filtering": {
        "enabled": false
      },
      "paging": {
        "enabled": true
      },
      "state": {
        "paging": false
      }
    });


    $('#edit-team-button').click(function(e){
       e.preventDefault();
       modalValue = 1;
       rules = [];
       rules = {
         'input_name':{
           required: true,
           minlength: 4
         },
         'input_description':{
           required: true,
           minlength: 10
         },
         'input_avatar':{
           required: false
         },
         'input_address':{
           required: true,
           minlength: 10
         },
         'input_city':{
           required: true
         },
         'input_province':{
           required: true
         },
         'input_coach_id':{
           required: true,
           number: true,
           min: 0
         }
       }
       $('#modal_title').text('Edit team');
       $('#submit').text('Save changes');
       $('#form_name').show();
       $('#form_description').show();
       $('#form_avatar').show();
       $('#form_address').show();
       $('#form_city').show();
       $('#form_province').show();
       $('#form_coach_id').show();

       $('#form_player_team_id').hide();
       $('#form_player_position_type_id').hide();
       $('#form_player_fullname').hide();
       $('#form_player_gender').hide();
       $('#form_player_avatar').hide();
       $('#form_player_address').hide();
       $('#form_player_bod').hide();
       $('#form_player_phone_number').hide();
       $('#form_player_player_number').hide();
       $('#form_player_player_status').hide();
       $('.fa-edit.modal-icon').show();
       $('.fa-plus-square.modal-icon').hide();

       $('#form_achievement_name').hide();
       $('#form_achievement_description').hide();
       $('#form_achievement_images').hide();
       $('#form_achievement_level').hide();
       $('#form_achievement_date').hide();
       // $('#form_achievement_coach_id').hide(); // hideen from view
       // $('#form_achievement_athlete_id').hide(); // hideen from view
       $('#form_achievement_team_id').hide();

       // remove
       $('#input_player_fullname').val('');
       $('#input_player_avatar').val('');
       $('#input_player_phone_number').val('');
       $('#input_player_player_number').val('');
       $('#input_player_bod').val('');
       $('#input_player_address').val('');

       $('#modal').modal({backdrop: 'static', keyboard: false});
       $('#modal').modal('show');
    });

    // Add for atheltes button
    $('#add-athlete-button').click(function(e){
       e.preventDefault();
       modalValue = 2;
       rules = [];
       rules = {
         'input_player_team_id':{
           required: true
         },
         'input_player_position_type_id':{
           required: true,
         },
         'input_player_fullname':{
           required: true,
           minlength: 4
         },
         'input_player_gender':{
           required: true
         },
         'input_player_avatar':{
           required: true
         },
         'input_player_address':{
           required: true
         },
         'input_player_bod':{
           required: true,
           date: true
         },
         'input_player_phone_number':{
           required: true,
           min: 0,
           minlength: 8
         },
         'input_player_number':{
           required: true,
           min: 0
         },
         'input_player_status':{
           required: true
         }
       }
       $('#modal_title').text('Add player');
       $('#submit').text('Submit');
       $('#form_name').hide();
       $('#form_description').hide();
       $('#form_avatar').hide();
       $('#form_address').hide();
       $('#form_city').hide();
       $('#form_province').hide();
       $('#form_coach_id').hide();

       $('#form_player_team_id').show();
       $('#form_player_position_type_id').show();
       $('#form_player_fullname').show();
       $('#form_player_gender').show();
       $('#form_player_avatar').show();
       $('#form_player_address').show();
       $('#form_player_bod').show();
       $('#form_player_phone_number').show();
       $('#form_player_player_number').show();
       $('#form_player_player_status').show();

       $('#form_achievement_name').hide();
       $('#form_achievement_images').hide();
       $('#form_achievement_level').hide();
       $('#form_achievement_date').hide();
       $('#form_achievement_description').hide();
       // $('#form_achievement_coach_id').hide(); // hideen from view
       // $('#form_achievement_athlete_id').hide(); // hideen from view
       $('#form_achievement_team_id').hide();

       $('.fa-edit.modal-icon').hide();
       $('.fa-plus-square.modal-icon').show();
       $('#modal').modal({backdrop: 'static', keyboard: false});
       $('#modal').modal('show');
    });

    // Add achiement button
    $('#add-achievement-button').click(function(e){
       e.preventDefault();
       modalValue = 3;
       rules = [];
       rules = {
         'input_achievement_name':{
           required: true,
           minlength: 4
         },
         'input_achievement_description':{
           required: true,
           minlength: 8
         },
         'input_achievement_images':{
           required: true
         },
         'input_achievement_level':{
           required: true
         },
         'input_achievement_date':{
           required: true,
           date: true
         },
         'input_achievement_athlete_id':{
           required: false
         },
         'input_achievement_coach_id':{
           required: false,
         },
         'input_achievement_team_id':{
           required: true,
         }
       }
       $('#modal_title').text('Add player');
       $('#submit').text('Submit');
       $('#form_name').hide();
       $('#form_description').hide();
       $('#form_avatar').hide();
       $('#form_address').hide();
       $('#form_city').hide();
       $('#form_province').hide();
       $('#form_coach_id').hide();

       $('#form_player_team_id').hide();
       $('#form_player_position_type_id').hide();
       $('#form_player_fullname').hide();
       $('#form_player_gender').hide();
       $('#form_player_avatar').hide();
       $('#form_player_address').hide();
       $('#form_player_bod').hide();
       $('#form_player_phone_number').hide();
       $('#form_player_player_number').hide();
       $('#form_player_player_status').hide();

       $('#form_achievement_name').show();
       $('#form_achievement_images').show();
       $('#form_achievement_level').show();
       $('#form_achievement_date').show();
       $('#form_achievement_description').show();
       // $('#form_achievement_coach_id').show(); // hideen from view
       // $('#form_achievement_athlete_id').show(); // hideen from view
       $('#form_achievement_team_id').show();

       // remove
       $('#input_achievement_name').val('');
       $('#input_achievement_images').val('');
       $('#input_achievement_date').val('');
       $('#input_achievement_description').val('');

       $('.fa-edit.modal-icon').hide();
       $('.fa-plus-square.modal-icon').show();
       $('#modal').modal({backdrop: 'static', keyboard: false});
       $('#modal').modal('show');
    });

    var l = $( '#submit' ).ladda();
    l.click(function(){
      $("#form").validate({
          rules: rules,
          submitHandler : function(form){
            l.ladda( 'start' );

            var params = new FormData();
            var url;
            if(modalValue == 1){
              let image = document.querySelector('#input_avatar');
              url = _URL+"api/teams/update/{{$team['id']}}";
              params.append("name", $('#input_name').val());
              params.append("description", $('#input_description').val());
              params.append("address", $('#input_address').val());
              params.append("city", $('#input_city').val());
              params.append("province", $('#input_province').val());
              params.append("coach_id", $('#input_coach_id').val());
              if( image.files.length != 0){
                params.append("file", image.files[0]);
              }
            }else if (modalValue == 2) {
              let image = document.querySelector('#input_player_avatar');
              url = _URL+"api/athletes";
              params.append("team_id", $('#input_player_team_id').val());
              params.append("position_type_id", $('#input_player_position_type_id').val());
              params.append("fullname", $('#input_player_fullname').val());
              params.append("gender", $('#input_player_gender').val());
              params.append("file", image.files[0]);
              params.append("address", $('#input_player_address').val());
              params.append("bod", $('#input_player_bod').val());
              params.append("phone_number", $('#input_player_phone_number').val());
              params.append("player_number", $('#input_player_player_number').val());
              params.append("player_status", $('#input_player_player_status').val());
            }else if (modalValue == 3) {
              let image = document.querySelector('#input_achievement_images');
              url = _URL+"api/achievements";
              params.append("name", $('#input_achievement_name').val());
              params.append("date", $('#input_achievement_date').val());
              params.append("level", $('#input_achievement_level').val());
              params.append("description", $('#input_achievement_description').val());
              params.append("team_id", $('#input_achievement_team_id').val());
              params.append("file", image.files[0]);
            }

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

                if(modalValue == 1){
                  document.getElementById("updated_team_name").innerHTML = res.data.name;
                  document.getElementById("updated_team_description").innerHTML = res.data.description;
                  document.getElementById("updated_team_city").innerHTML = res.data.city;
                  document.getElementById("updated_team_province").innerHTML = res.data.province;
                  document.getElementById("updated_team_image").src = _URL + "storage/"+res.data.avatar;
                  document.getElementById("updated_team_address").innerHTML = res.data.address;;
                }else if (modalValue == 2) {
                  ft.rows.add({
                    avatar: res.data.athlete.avatar,
                    fullname: res.data.athlete.fullname,
                    gender: res.data.athlete.gender,
                    position_type: res.data.athlete.position_type.name,
                    phone_number: res.data.athlete.phone_number,
                    player_status: res.data.athlete.player_status,
                  });
                }else if (modalValue == 3) {
                  ftAchievement.rows.add({
                    images: res.data.achievement.images,
                    name: res.data.achievement.name,
                    level: res.data.achievement.level,
                    description: res.data.achievement.description,
                    date: res.data.achievement.date,
                  });
                }

                swal({
                  title: "Success",
                  text: res.message,
                  type: "success"
                },function(isConfirm){
                  l.ladda('stop');
                  $('#modal').modal('hide');
                  // window.location = _URL + res.data.url;
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
