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
                        <th>Team</th>
                        <th>Scores</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Patrick Smith</td>
                        <td>Man</td>
                        <td>Striker</td>
                        <td><strong>FILKOM</strong></td>
                        <td>50</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Lucinta</td>
                        <td>Woman</td>
                        <td>Back</td>
                        <td><strong>FILKOM</strong></td>
                        <td>30</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Maria</td>
                        <td>Woman</td>
                        <td>Keeper</td>
                        <td><strong>FILKOM</strong></td>
                        <td>80</td>
                      </tr>
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
});

</script>
@endsection
