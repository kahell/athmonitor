@extends('user/dashboard')

@section('title','Dashboard User')

@section('main_content')
  <div id="wrapper">
    @include('user/layouts_dashboard/ud_sidebar_nav_dashboard')

    <div id="page-wrapper" class="gray-bg dashbard-1">
      @include('user/layouts_dashboard/ud_top_nav_dashboard')
      @include('user/layouts_dashboard/ud_header_title_dashboard')
      <div class="wrapper wrapper-content">
        @if ($activity != "[]")
          <div class="ibox-content m-b-sm border-bottom">

              <div class="row">
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label class="control-label" for="product_name">Date</label>
                          <p>{{$activity->time}}</p>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="form-group">
                          <label class="control-label" for="price">Place</label>
                          <p>{{$activity->place}}</p>
                      </div>
                  </div>
                  <div class="col-sm-2">
                      <div class="form-group">
                          <label class="control-label" for="quantity">Type</label>
                          <p>{{$activity->type}}</p>
                      </div>
                  </div>
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label class="control-label" for="status">Status</label>
                          @if ($activity->status == "active")
                            <span class='label label-primary'>Active</span>
                          @else
                            <span class='label label-default'>In-Active</span>
                          @endif
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
                @if ($activity == "[]")
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
                            <td data-value='{{$key->player_status}}'></td>
                            <td data-value='{{$key->athlete_id}}' class="text-right"></td>
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


      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
  $(document).ready(function() {
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
              return '<td><span class="label label-primary">Done</span><td>';
            }else if (value == "pending") {
              return '<td><span class="label label-danger">Pending</span><td>';
            }
            return "";
          }
        },
        {name: "athlete_id",
          formatter: function(value){
            if (value == "done"){
              "<td class='text-right'>"
              +"<div class='btn-group'>"
              +"<a href='activity/"+value+"/edit' class='btn-white btn btn-xs'>Edit</a>"
              +"</div>"
              +"</td>"
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

  });

  </script>
@endsection
