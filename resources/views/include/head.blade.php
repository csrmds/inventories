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
		
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="{{ url('/') }}">HOME</a>
			</li>
		</ul>

		<form class="form-inline my-2 my-lg-0">
			<div class="navbar-nav">
				<li class="nav-item dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<a class="nav-link dropdown-toggle">Usuario</a>
					<div class="dropdown-menu">
						<a class="dropdown-item">Usuário</a>
						<a class="dropdown-item">Logout</a>
					</div>
				</li>	
			</div>
		</form>

	</div>
</nav>

