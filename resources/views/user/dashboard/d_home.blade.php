@extends('user/dashboard')

@section('title','Dashboard User')

@section('main_content')
  <div id="wrapper">
    @include('user/layouts_dashboard/ud_sidebar_nav_dashboard')

    <div id="page-wrapper" class="gray-bg dashbard-1">
      @include('user/layouts_dashboard/ud_top_nav_dashboard')
      <div class="wrapper wrapper-content">
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h5>Your Teams</h5>
                <div class="pull-right">
                  <div class="btn-group">
                    <button type="button" class="btn btn-xs btn-white active">Today</button>
                    <button type="button" class="btn btn-xs btn-white">Monthly</button>
                    <button type="button" class="btn btn-xs btn-white">Annual</button>
                  </div>
                </div>
              </div>
              <div class="ibox-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="flot-chart">
                      <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox">
              <div class="ibox-title">
                <h5>Your Players</h5>
              </div>
              <div class="ibox-content">
                <div class="table-responsive">
                  <table id="player_table" class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Position</th>
                        <th>Player Number</th>
                        <th>Status</th>
                        <th>Scores</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($collectAthlete as $key)
                        <tr>
                          <td>{{$key->id}}</td>
                          <td>{{$key->fullname}}</td>
                          <td>{{$key->gender}}</td>
                          <td>{{$key->position_type->name}}</td>
                          <td>{{$key->player_number}}</td>
                          <td>
                            @if ($key->player_status === "active")
                              <span class='label label-primary'>Active</span>
                            @else
                              <span class='label label-default'>In-active</span>
                            @endif
                          </td>
                          <td>50</td>
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

      <!-- Modal -->
      <div class="modal inmodal" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content animated bounceInRight">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <i class="fa fa-plus-square modal-icon"></i>
                      <h4 class="modal-title">Add new Team</h4>
                      <small class="font-bold">Please fill all related field.</small>
                  </div>
                  <form role="form" id="form" >
                    <div class="modal-body">
                        @foreach ($form as $key => $value)
                          <div class="form-group">
                            <label>{{ucfirst($key)}}</label>
                            @if ($key === "avatar")
                              <input id="input_{{ $key }}" name="input_{{ $key }}" type="file" class="form-control">
                            @elseif ($key === "description")
                              <textarea id="input_{{ $key }}" name="input_{{ $key }}" placeholder="Enter {{ $key }}" class="form-control"></textarea>
                            @elseif ($key === "address")
                              <textarea id="input_{{ $key }}" name="input_{{ $key }}" placeholder="Enter {{ $key }}" class="form-control"></textarea>
                            @elseif ($key === "coach_id")
                              <input id="input_{{ $key }}" name="input_{{ $key }}" type="text" placeholder="Enter {{ $key }}" value="{{ $coach['id'] }}" class="form-control" disabled>
                            @else
                              <input id="input_{{ $key }}" name="input_{{ $key }}" type="text" placeholder="Enter {{ $key }}" class="form-control">
                            @endif

                          </div>
                        @endforeach
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
@endsection

@section('script')
  <script>
  $(document).ready(function() {
    row = FooTable.getRow(this);
    ft = FooTable.init('#player_table', {
      "columns": [
        {name: "athlete_id", type: "number"},
        {name: "name"},
        {name: "gender"},
        {name: "position"},
        {name: "team"},
        {name: "scores"}
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

    var data2 = [
      [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
      [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
      [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
      [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
      [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
      [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
      [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
      [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
    ];

    var data3 = [
      [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
      [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
      [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
      [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
      [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
      [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
      [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
      [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
    ];

    var dataset = [
      {
        label: "Scores",
        data: data3,
        color: "#1ab394",
        bars: {
          show: true,
          align: "center",
          barWidth: 24 * 60 * 60 * 600,
          lineWidth:0
        }

      }
    ];

    var options = {
      xaxis: {
        mode: "time",
        tickSize: [3, "day"],
        tickLength: 0,
        axisLabel: "Date",
        axisLabelUseCanvas: true,
        axisLabelFontSizePixels: 12,
        axisLabelFontFamily: 'Arial',
        axisLabelPadding: 10,
        color: "#d5d5d5"
      },
      yaxes: [{
        position: "left",
        max: 1070,
        color: "#d5d5d5",
        axisLabelUseCanvas: true,
        axisLabelFontSizePixels: 12,
        axisLabelFontFamily: 'Arial',
        axisLabelPadding: 3
      }
    ],
      legend: {
        noColumns: 1,
        labelBoxBorderColor: "#000000",
        position: "nw"
      },
      grid: {
        hoverable: false,
        borderWidth: 0
      }
    };

  function gd(year, month, day) {
    return new Date(year, month - 1, day).getTime();
  }

  $.plot($("#flot-dashboard-chart"), dataset, options);

  $('#add-new-team-button').click(function(e){
     e.preventDefault();
     $('#input_name').val('');
     $('#input_avatar').val('');
     $('#input_description').val('');
     $('#input_address').val('');
     $('#input_city').val('');
     $('#input_province').val('');
     $('.fa-plus-square').show();
  });

  var l = $( '#submit' ).ladda();
  l.click(function(){
    $("#form").validate({
        rules: {
          'input_name':{
            required: true,
            minlength: 4
          },
          'input_description':{
            required: true,
            minlength: 10
          },
          'input_avatar':{
            required: true
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
        },
        submitHandler : function(form){
          l.ladda( 'start' );

          let params =  new FormData();
          let url = document.querySelector('#input_avatar');

          params.append("name", $('#input_name').val());
          params.append("description", $('#input_description').val());
          params.append("address", $('#input_address').val());
          params.append("city", $('#input_city').val());
          params.append("province", $('#input_province').val());
          params.append("coach_id", $('#input_coach_id').val());
          params.append("file", url.files[0]);;

          axios.post(_URL+'api/teams',params,{
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
                window.location = _URL + res.data.url;
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
