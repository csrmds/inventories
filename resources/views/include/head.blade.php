<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('titulo')</title>

	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="#">INVENTORIES</a>

	<div class="collapse navbar-collapse">
		<ul class="navbar-nav">
			
			<li class="nav-item">
				<a class="nav-link" href="{{ url('/') }}">HOME</a>
			</li>
			
		</ul>
	</div>
</nav>

