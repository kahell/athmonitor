<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>@yield('title')</title>
<!-- Favicon -->
<link rel="apple-touch-icon" type="image/png" sizes="57x57" href="{{asset('images/fav/57x57.png')}}">
<link rel="apple-touch-icon" type="image/png" sizes="60x60" href="{{asset('images/fav/57x57.png')}}">
<link rel="apple-touch-icon" type="image/png" sizes="72x72" href="{{asset('images/fav/72x72.png')}}">
<link rel="apple-touch-icon" type="image/png" sizes="76x76" href="{{asset('images/fav/76x76.png')}}">
<link rel="apple-touch-icon" type="image/png" sizes="114x114" href="{{asset('images/fav/114x114.png')}}">
<link rel="apple-touch-icon" type="image/png" sizes="120x120" href="{{asset('images/fav/120x120.png')}}">
<link rel="apple-touch-icon" type="image/png" sizes="144x144" href="{{asset('images/fav/144x144.png')}}">
<link rel="apple-touch-icon" type="image/png" sizes="152x152" href="{{asset('images/fav/152x152.png')}}">
<link rel="apple-touch-icon" type="image/png" sizes="180x180" href="{{asset('images/fav/180x180.png')}}">
<link rel="icon" type="image/png" sizes="192x192" href="{{asset('images/fav/192x192.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/fav/32x32.png')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/fav/96x96.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/fav/16x16.png')}}">

<!-- Main Inspia -->
<link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
<!-- Fontawesome -->
<link href="{{asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
<!-- Style -->
<link href="{{asset('admin/css/style.css')}}" rel="stylesheet">
<!-- Toastr style -->
<link href="{{asset('admin/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
<!-- Gritter -->
<link href="{{asset('admin/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">
<!-- Animate -->
<link href="{{asset('admin/css/animate.css')}}" rel="stylesheet">
<!-- FooTable -->
<!-- <link href="assets/css/plugins/footable/footable.core.css" rel="stylesheet"> -->
<link href="{{asset('admin/css/plugins/footable/src/css/footable.standalone.css')}}" rel="stylesheet">
<!-- DataTable -->
<link href="{{asset('admin/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
<!-- sweetalert -->
<link href="{{asset('admin/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
<!-- Chosen -->
<link href="{{asset('admin/css/plugins/chosen/chosen.css')}}" rel="stylesheet">
<!-- ClockPicker -->
<link href="{{asset('admin/css/plugins/clockpicker/clockpicker.css')}}" rel="stylesheet">
<!-- Datepicker -->
<link href="{{asset('admin/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
<!-- Ladda Button-->
<link href="{{asset('admin/css/plugins/ladda/ladda-themeless.min.css')}}" rel="stylesheet">
<!-- NO UI Slider -->
{{-- <link href="{{asset('admin/css/plugins/nouslider/jquery.nouislider.css')}}" rel="stylesheet"> --}}
<link href="{{asset('admin/css/plugins/nouslider/nouislider.min.css')}}" rel="stylesheet">


@section('css-style')
@show

<script type="text/javascript">
var _URL = {!! json_encode(url('/')) !!} + '/';
let headers={
    Authorization : 'Bearer '+ localStorage.getItem('token'),
    'Content-Type':'application/x-www-form-urlencoded'
};
</script>
