<!DOCTYPE html>
	<head>
		@include('user/layouts/u_head_dashboard')
	</head>
	<body>
	@extends('user/layouts/u_header')

		@section('main_content')
			@show

	@include('user/layouts/u_footer')

	@include('user/layouts/u_bottom_dashboard')
	</body>
</html>
