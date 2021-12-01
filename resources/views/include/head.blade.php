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
			@if (Auth::check() || Auth::guard('ldapusers')->check())
			<li class="nav-item">
				<a class="nav-link" href="{{ route('people.index') }}">PESSOAS</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('product.index') }}">PRODUTOS</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('group.index') }}">GRUPOS</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('location') }}">LOCAIS</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('csv') }}">CSV</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('teste') }}">TESTE</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('ldap.home') }}">LDAP</a>
			</li>
			@endif
		</ul>

		<ul class="navbar-nav ml-auto">
			<!-- Authentication Links -->
			@guest
				@if (Route::has('login'))
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
					</li>
				@endif

				@if (Route::has('register'))
					<li class="nav-item">
						<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
					</li>
				@endif
			@else
				{{-- <li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						{{ Auth::user()->name }}
					</a>

					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{ route('logout') }}"
						   onclick="event.preventDefault();
										 document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</div>
				</li> --}}
			@endguest
		</ul>

		@if (Auth::check() || Auth::guard('ldapusers')->check())
		<?php 
			$userLogin= session()->get('userLogin');
		?>
		<form class="form-inline my-2 my-lg-0" id="logout-form" action="{{ route('authenticate.logout') }}" method="POST">
			@csrf
			<div class="navbar-nav">
				<li class="nav-item dropdown" >
					<a 
						class="nav-link dropdown-toggle" 
						id="navbarDropdown" 
						role="button" 
						data-toggle="dropdown" 
						aria-haspopup="true" 
						aria-expanded="false">
						{{ $userLogin['name'] }} {{ $userLogin['guard']=="ldapusers" ? " AD" : null }}
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a 
							class="dropdown-item" 
							href="" 
							onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							Logout
						</a>
					</div>
				</li>	
			</div>
		</form>
		@endif

	</div>
</nav>

