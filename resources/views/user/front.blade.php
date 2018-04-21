<!DOCTYPE html>
	<head>
		@include('user/layouts_front/uf_head_dashboard')
	</head>
	<body>
	@extends('user/layouts_front/uf_header')

		@section('main_content')
			@show

	@include('user/layouts_front/uf_footer')

	@include('user/layouts_front/uf_bottom_dashboard')
	</body>
</html>
