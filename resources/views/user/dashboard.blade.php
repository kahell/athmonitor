<!DOCTYPE html>
<html>
<head>
  @include('user/layouts_dashboard/ud_head_dashboard')
</head>
<body class="@yield('body_color')">

  @section('main_content')
  @show

  @include('user/layouts_dashboard/ud_bottom_dashboard')

  @section('script')
  @show
</body>
</html>
