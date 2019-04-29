<!DOCTYPE html>
<html>
<head>
	<title>Aladin System</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	<meta name="csrf-token" content="{{csrf_token()}}" charset="utf-8">
	<style type="text/css">
		body{
			padding: 30px; 
			background-image: url({{url('svg/503.svg')}}); 
			background-repeat: no-repeat;
			overflow: hidden;
		}
		#rowLogin{
			width: 100%;
			height: 992px;
		}
	</style>
</head>
<body>

	<div class="container">

		<div class="main">
			@hasSection('body')
				@yield('body')
			@endif	 
		</div>

	</div>

	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

	@hasSection('jquery')
		@yield('jquery')
	@endif
</body>
</html>