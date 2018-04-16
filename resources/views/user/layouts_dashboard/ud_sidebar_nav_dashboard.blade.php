<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                  <span>
                    @if (is_null(old('avatar')))
                      <img alt="image" class="img-circle" src="{{asset('images/profile_small.jpg')}}" />
                    @else
                      <img alt="image" class="img-circle" src="{{asset(old('avatar'))}}" />
                    @endif
                  </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                      <span class="clear">
                        <span class="block m-t-xs"> <strong class="font-bold">{{ $coach['user']->fullname }}</strong>
                        </span>
                        <span class="text-muted text-xs block">{{ $team['name'] }} <b class="caret"></b></span>
                      </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                      @foreach ($coach['team'] as $key)
                        <li><a href="{{url('users/'.$key->team_id)}}">{{$key->name}}</a></li>
                      @endforeach
                    </ul>
                </div>
            </li>
            <li class="{{ ($data['parent_nav'] == "home") ? "active" : "" }}">
                <a id="home" href="{{url('users/'.$team['team_id'])}}"><i class="fa fa-home"></i><span class="nav-label">Home</span></a>
            </li>
            <li class="{{ ($data['parent_nav'] == "team") ? "active" : "" }}">
                <a id="user" href="#"><i class="fa fa-users"></i> <span class="nav-label">Team </span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ ($data['child_nav'] == "team" || $data['child_nav'] == "detail") ? "active" : "" }}"><a href="{{url('users/'.$team['team_id'].'/team')}}">Team</a></li>
                </ul>
            </li>
            <li class="{{ ($data['parent_nav'] == "monitor") ? "active" : "" }}">
                <a id="user" href="#"><i class="fa fa-laptop"></i> <span class="nav-label">Monitor </span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ ($data['child_nav'] == "monitor") ? "active" : "" }}"><a href="{{url('users/'.$team['team_id'].'/monitor')}}">Monitor</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
