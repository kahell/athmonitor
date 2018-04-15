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
          <div class="col-lg-9">
            <div class="wrapper wrapper-content animated fadeInUp">
              <div class="ibox">
                <div class="ibox-content">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="m-b-md">
                        <a href="#" class="btn btn-white btn-xs pull-right">Edit athlete</a>
                        <h2>Athlete</h2>
                      </div>
                      <dl class="dl-horizontal">
                        <dt>Status:</dt> <dd><span class="label label-primary">Active</span></dd>
                      </dl>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-5">
                      <dl class="dl-horizontal">

                        <dt>Coach:</dt> <dd>{{$user['username']}}</dd>
                        <dt>City:</dt> <dd>  {{$team['city']}}</dd>
                        <dt>Province:</dt> <dd> {{$team['province']}}</dd>
                      </dl>
                    </div>
                    <div class="col-lg-7" id="cluster_info">
                      <dl class="dl-horizontal" >

                        <dt>Created Team:</dt> <dd> 2018</dd>
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

                              <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                  <tbody>
                                    <tr>
                                      <td class="client-avatar"><img alt="image" src="{{asset('images/profile_small.jpg')}}"> </td>
                                      <td><a data-toggle="tab" href="#contact-1" class="client-link" aria-expanded="true">Anthony Jackson</a></td>
                                      <td> Tellus Institute</td>
                                      <td class="contact-type"><i class="fa fa-envelope"> </i></td>
                                      <td> gravida@rbisit.com</td>
                                      <td class="client-status"><span class="label label-primary">Good</span></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>

                            </div>
                            <div class="tab-pane" id="tab-2">
                              <div class="table-responsive">

                                <table class="table table-striped">
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
                                    <tr>
                                      <td>
                                        <span class="label label-primary">National</span>
                                      </td>
                                      <td class="client-avatar">
                                        <img alt="image" src="{{asset('images/profile_small.jpg')}}">
                                      </td>
                                      <td>
                                        DBL Indonesia
                                      </td>
                                      <td>
                                        2018
                                      </td>
                                      <td>
                                        <p class="small">
                                          Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable.
                                        </p>
                                      </td>
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
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="wrapper wrapper-content project-manager">
              <h4>{{ $team['name']}}</h4>
              <img src="{{ (empty($team['avatar']))? asset('images/profile_small.jpg') : asset($team['avatar'])}}" class="img-responsive">
              <p class="small">
                {{ $team['description']}}
              </p>
              <p class="small font-bold">
                {{-- <span><i class="fa fa-circle text-green"></i> Active</span> --}}
              </p>
              <div class="text-center m-t-md">
                <a href="#" class="btn btn-xs btn-primary">Add Players</a>
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
