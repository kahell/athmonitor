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
                <h5>{{ ucfirst($data['child_nav'])}} Management</h5>
              </div>
              <div class="ibox-content">
                <div class="table-responsive">
                  <table id="player_table" class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Province</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Jakarta Football</td>
                        <td>JL. Pondok Timur</td>
                        <td>Jakarta</td>
                        <td><strong>Jakarta Selatan</strong></td>
                        <td><a href="#">View</a></td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Bekasi Football</td>
                        <td>JL. Narogong</td>
                        <td>Bekasi</td>
                        <td><strong>Bekasi Timur</strong></td>
                        <td><a href="#">View</a></td>
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
