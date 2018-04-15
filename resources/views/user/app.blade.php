<!DOCTYPE html>
	<head>
		@include('user/layouts/uf_head_dashboard')
	</head>
	<body>
	@extends('user/layouts/uf_header')

		@section('main_content')
			@show

	@include('user/layouts/uf_footer')

	@include('user/layouts/uf_bottom_dashboard')
	</body>
</html>
