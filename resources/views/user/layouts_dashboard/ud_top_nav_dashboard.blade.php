<div class="row border-bottom">
    <!--<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">-->
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
          <li>
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <span class="text-muted text-xs block">{{ $team['name'] }} <b class="caret"></b></span>
            </a>
            <ul class="dropdown-menu animated fadeInRight m-t-xs">
              @foreach ($collectTeam as $key)
                <li><a href="{{url('users/'.$key->id)}}">{{$key->name}}</a></li>
              @endforeach
            </ul>
          </li>
          <li>
              <a href="{{ url('logout') }}">
                  <i class="fa fa-sign-out"></i> Log out
              </a>
          </li>
        </ul>
    <!--</nav>-->
</div>
