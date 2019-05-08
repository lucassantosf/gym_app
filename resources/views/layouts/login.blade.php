<!DOCTYPE html>
<html>
<head>
	<title>Aladin System</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	<meta name="csrf-token" content="{{csrf_token()}}" charset="utf-8">
    <link rel="shortcut icon" href="{{url('svg/favicon.png')}}" type="imagem/png" /> 
	<style type="text/css">
		body,html {  
			width: 100%;
    		height: 100%;
			background-image: linear-gradient(to bottom, #B0E0E6, white);  
			background-repeat: no-repeat;
		} 
	</style> 
</head>
<body> 
    <div style="position: absolute; left: 44%">
        <img src="{{url('svg/aladin.png')}}" width="160" height="70" style="opacity : 0.7"> 
    </div>  
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