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
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                     </span> <span class="text-muted text-xs block">Art Director </span> </span> </a>
                </div>
            </li>
            <li  class="@if (old('parent_nav') == "home") active @else "" @endif">
                <a id="home" href="{{url('users')}}"><i class="fa fa-home"></i><span class="nav-label">Home</span></a>
            </li>
            <li class="@if (old('parent_nav') == "team") active @else "" @endif">
                <a id="user" href="#"><i class="fa fa-user"></i> <span class="nav-label">Team </span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="@if (old('child_nav') == 'team') active @else '' @endif"><a href="{{url('users/team')}}">Team</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
