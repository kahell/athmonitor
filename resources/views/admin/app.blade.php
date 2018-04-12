<!DOCTYPE html>
<html>
<head>
  @include('admin/layouts/a_head_dashboard')
</head>
<body class="@yield('body_color')">

  @section('admin/layouts/a_header_title_dashboard')
  @show

  @section('main_content')
  @show

  @include('admin/layouts/a_bottom_dashboard')

  @section('script')
  @show
</body>
</html>
