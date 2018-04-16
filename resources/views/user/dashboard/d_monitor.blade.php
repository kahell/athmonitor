@extends('user/dashboard')

@section('title','Dashboard User')

@section('main_content')
  <div id="wrapper">
    @include('user/layouts_dashboard/ud_sidebar_nav_dashboard')

    <div id="page-wrapper" class="gray-bg dashbard-1">
      @include('user/layouts_dashboard/ud_top_nav_dashboard')
      @include('user/layouts_dashboard/ud_header_title_dashboard')
      <div class="wrapper wrapper-content">
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
                      @foreach ($athlete as $key)
                        <tr>
                          <td>{{$key->athlete_id}}</td>
                          <td>{{$key->fullname}}</td>
                          <td>{{$key->gender}}</td>
                          <td>{{$key->position_types}}</td>
                          <td>{{$key->player_number}}</td>
                          <td><span class='label label-primary'>{{$key->player_status}}</span></td>
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
    </div>
  </div>
@endsection

@section('script')
  <script>
  $(document).ready(function() {
    row = FooTable.getRow(this);
    ft = FooTable.init('#player_table', {
      "columns": [
        {name: "team_id", type: "number"},
        {name: "name"},
        {name: "address"},
        {name: "city"},
        {name: "province"},
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
